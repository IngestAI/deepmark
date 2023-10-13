<?php

namespace App\Jobs;

use App\Data\QueryAiModelRequest;
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
        $task->fill(['progress' => 0])->save();
        $iterationProgress = 100 / count($task->data['models']);
        foreach ($task->data['models'] as $i => $model)
        {
            $request = new QueryAiModelRequest($model, $task->data['prompt']);
            $modelEntity = AIModel::where('slug', $model)->first();
            $provider = AIProvider::find($modelEntity['provider_id']);
            $response = AiFactory::provider($provider['slug'])
                ->model($model)
                ->send($request->model);

            if ($response->isSuccessful()) {
                $promptRequest = new PromptRequest();
                $promptRequest->prompt = $task->data['prompt'];
                $promptRequest->data = json_encode(['answers' => $response->getAnswer()]);
                $promptRequest->task_id = $task->id;
                $promptRequest->model_id = $modelEntity->id;
                $promptRequest->position = ++$i;
                $promptRequest->save();
            }
            $task->fill([
                'progress' => $task->progress + $iterationProgress
            ])->save();
        }

        $task->fill([
            'progress' => 100,
            'status' => empty($answers)
                ? (string) TaskStatusEnum::failed()
                : (string) TaskStatusEnum::success()
        ])->save();
    }
}
