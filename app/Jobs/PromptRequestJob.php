<?php

namespace App\Jobs;

use App\Data\QueryAiModelRequest;
use App\Enums\PromptRequestConditionEnum;
use App\Enums\PromptRequestStatusEnum;
use App\Enums\TaskStatusEnum;
use App\Models\AIModel;
use App\Models\AIProvider;
use App\Models\PromptRequest;
use App\Models\Task;
use App\Models\TaskModel;
use App\Services\Ai\AiFactory;
use App\Services\Ai\Conditions\ConditionStrategyContext;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelData\Data;

class PromptRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Data $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $task = $this->data->task;
        $model = $this->data->model;
        $position = $this->data->position;
        $progress = $this->data->progress;

        $request = new QueryAiModelRequest($model, $task->data['prompt']);
        $modelEntity = AIModel::where('slug', $model)->first();
        $provider = AIProvider::find($modelEntity['provider_id']);

        $task->fill([
            'status' => (string) TaskStatusEnum::running()
        ])->save();

        $promptRequest = PromptRequest::create([
            'prompt' => $task->data['prompt'],
            'task_id' => $task->id,
            'model_id' => $modelEntity->id,
            'position' => $position,
            'status' => (string) PromptRequestStatusEnum::waiting(),
        ]);

        $response = AiFactory::provider($provider['slug'])
            ->model($model)
            ->send($request->model);

        if ($response->isSuccessful()) {
            $answer = $response->getAnswer();
            $condition = $task->data['condition'] ?? '';
            $strategy = ConditionStrategyContext::make($condition);
            $data = [
                'answer' => $answer,
                'match' => $strategy->apply($answer, $task->data['term']),
            ];
            if ($condition === (string) PromptRequestConditionEnum::vectorSimilarity()) {
                $data['similarity'] = $strategy->similarity;
            }
            $promptRequest->data = $data;
            $promptRequest->status = (string) PromptRequestStatusEnum::success();
        } else {
            $promptRequest->status = (string) PromptRequestStatusEnum::failed();
            Log::channel('tasks')->debug('Model: ' . $model->fullname);
            Log::channel('tasks')->debug('Wrong response: ' . json_encode($response->response));
        }
        $promptRequest->save();

        $task->fill([
            'progress' => $progress
        ])->save();

        if ($task->progress == 100) {
            $task->fill([
                'status' => (string) TaskStatusEnum::success()
            ])->save();

            if ($condition === (string) PromptRequestConditionEnum::vectorSimilarity()) {
                $this->calculateMinMaxScore($task);
            } else {
                $this->calculateScore($task);
            }
        }
    }

    private function calculateScore(Task $task)
    {
        $matchTrueQueryResult = PromptRequest::getModelsMatches($task->id);
        $matchFalseQueryResult = PromptRequest::getModelsMatches($task->id, false);
        $modelIds = $task->promptRequests->pluck('model_id')->all();

        $matchTrue = $matchFalse = [];
        foreach ($matchTrueQueryResult as $item) {
            $matchTrue[$item->model_id] = $item->cnt;
        }
        foreach ($matchFalseQueryResult as $item) {
            $matchFalse[$item->model_id] = $item->cnt;
        }

        $data['score'] = 0;
        foreach (array_unique($modelIds) as $modelId) {
            $taskModel = new TaskModel();
            if (!isset($matchTrue[$modelId]) && isset($matchFalse[$modelId])) {
                $data['score'] = 0;
            }

            if (!isset($matchFalse[$modelId]) && isset($matchTrue[$modelId])) {
                $data['score'] = 100;
            }

            if (isset($matchTrue[$modelId]) && isset($matchFalse[$modelId])) {
                $data['score'] = $matchTrue[$modelId] / ($matchTrue[$modelId] + $matchFalse[$modelId]) * 100;
            }

            $taskModel->task_id = $task->id;
            $taskModel->model_id = $modelId;
            $taskModel->match = $data;
            $taskModel->save();
        }
    }

    private function calculateMinMaxScore(Task $task)
    {
        $minMaxQueryResult = PromptRequest::selectRaw('model_id, MIN(JSON_EXTRACT(data, "$.similarity")) as min, MAX(JSON_EXTRACT(data, "$.similarity")) as max, AVG(JSON_EXTRACT(data, "$.similarity")) as avg')
            ->where('task_id', $task->id)
            ->groupBy('model_id');

        foreach ($minMaxQueryResult as $resultItem) {
            $taskModel = new TaskModel();
            $taskModel->task_id = $task->id;
            $taskModel->model_id = $resultItem->model_id;
            $taskModel->match = [
                'min' => $resultItem->min,
                'max' => $resultItem->max,
                'avg' => $resultItem->avg
            ];
            $taskModel->save();
        }
    }
}
