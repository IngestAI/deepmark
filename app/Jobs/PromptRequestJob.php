<?php

namespace App\Jobs;

use App\Data\QueryAiModelRequest;
use App\Enums\PromptRequestConditionEnum;
use App\Enums\PromptRequestStatusEnum;
use App\Enums\TaskStatusEnum;
use App\Models\AIModel;
use App\Models\AIProvider;
use App\Models\PromptRequest;
use App\Services\Ai\AiFactory;
use App\Services\Ai\Conditions\ConditionStrategyContext;
use App\Services\Ai\Data\TextEmbeddingAda003AiModelRequest;
use App\Services\Ai\Enums\AiProviderEnum;
use App\Services\Ai\Enums\AiVectorModelEnum;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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
        }
    }

    public function failed(Throwable|null $e)
    {
        $this->data->task->fill([
            'progress' => $this->data->progress,
            'status' => (string) TaskStatusEnum::failed()
        ])->save();
    }
}
