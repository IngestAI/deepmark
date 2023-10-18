<?php

namespace App\Jobs;

use App\Data\QueryAiModelRequest;
use App\Enums\PromptRequestStatusEnum;
use App\Enums\TaskStatusEnum;
use App\Models\AIModel;
use App\Models\AIProvider;
use App\Models\PromptRequest;
use App\Services\Ai\AiFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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

        $promptRequest = new PromptRequest();
        $promptRequest->prompt = $task->data['prompt'];
        $promptRequest->task_id = $task->id;
        $promptRequest->model_id = $modelEntity->id;
        $promptRequest->position = $position;
        $promptRequest->status = (string) PromptRequestStatusEnum::waiting();
        $promptRequest->save();

        $response = AiFactory::provider($provider['slug'])
            ->model($model)
            ->send($request->model);

        if ($response->isSuccessful()) {
            $promptRequest->data = json_encode(['answer' => $response->getAnswer()]);
            $promptRequest->status = (string) PromptRequestStatusEnum::success();
        } else {
            $promptRequest->status = (string) PromptRequestStatusEnum::failed();
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
}
