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
use Throwable;

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

        try {
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

                if ($condition === (string) PromptRequestConditionEnum::vectorSimilarity()) {
                    $this->calculateMinMaxScore($task);
                } else {
                    $this->calculateScore($task);
                }
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
            }
        } catch (Throwable $e) {
            Log::channel('tasks')->error('Error: ' . $e->getMessage());
            $promptRequest->fill([
                'status' => (string) PromptRequestStatusEnum::failed(),
                'data' => ['error' => $e->getMessage()]
            ])->save();
            $task->fill([
                'progress' => $progress,
                'status' => (string) TaskStatusEnum::failed()
            ])->save();
        }
    }

    private function calculateScore(Task $task)
    {
        $results = [];
        $task->promptRequests()->each(function($promptRequest) use (&$results) {
            $results[$promptRequest->model_id][] = $promptRequest->data['match'] ?? false;
        });

        $data = [];
        foreach ($results as $modelId => $matches) {
            $trueModels = array_map(fn($item) => $item === true, $matches);
            $data[] = [
                    'task_id' => $task->id,
                    'model_id' => $modelId,
                    'match' => json_encode(['score' => count($trueModels) / count($matches) * 100]),
            ];
        }
        TaskModel::upsert($data, ['task_id', 'model_id']);
    }

    private function calculateMinMaxScore(Task $task)
    {
        $results = [];
        $task->promptRequests()->each(function($promptRequest) use (&$results) {
            $results[$promptRequest->model_id][] = $promptRequest->data['similarity'] ?? 0;
        });

        $data = [];
        foreach ($results as $modelId => $similarities) {
            $min = min($similarities);
            $max = max($similarities);
            $data[] = [
                'task_id' => $task->id,
                'model_id' => $modelId,
                'match' => json_encode([
                    'min' => $min,
                    'max' => $max,
                    'average' => ($min + $max) / 2,
                ]),
            ];
        }

        TaskModel::upsert($data, ['task_id', 'model_id']);
    }
}
