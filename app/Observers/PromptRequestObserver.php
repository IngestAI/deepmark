<?php

namespace App\Observers;

use App\Models\PromptRequest;
use App\Models\TaskModel;

class PromptRequestObserver
{
    /**
     * Handle the PromptRequest "created" event.
     */
    public function created(PromptRequest $promptRequest): void
    {
        //
    }

    /**
     * Handle the PromptRequest "updated" event.
     */
    public function updated(PromptRequest $promptRequest): void
    {
        $allPromptRequests = PromptRequest::task($promptRequest->task_id)->model($promptRequest->model_id)->get();
        $assessmentPromptRequests = $allPromptRequests->filter(fn($item) => $item->match)->all();
        $latencyPromptRequests = $allPromptRequests->map(fn($item) => $item->latency)->all();
        $errorPromptRequests = $allPromptRequests->filter(fn($item) => $item->error_rate)->all();

        $taskModel = TaskModel::where('task_id', $promptRequest->task_id)
            ->where('model_id', $promptRequest->model_id)
            ->first();
        if (!$taskModel) {
            $taskModel = new TaskModel();
            $taskModel->task_id = $promptRequest->task_id;
            $taskModel->model_id = $promptRequest->model_id;
        }
        $taskModel->match = [
            'assessment' => intval(count($assessmentPromptRequests) / count($allPromptRequests) * 100),
            'latency' => intval(array_sum($latencyPromptRequests) / count($allPromptRequests)),
            'error_rate' => intval(count($errorPromptRequests) / count($allPromptRequests) * 100),
        ];
        $taskModel->saveQuietly();
    }

    /**
     * Handle the PromptRequest "deleted" event.
     */
    public function deleted(PromptRequest $promptRequest): void
    {
        //
    }

    /**
     * Handle the PromptRequest "restored" event.
     */
    public function restored(PromptRequest $promptRequest): void
    {
        //
    }

    /**
     * Handle the PromptRequest "force deleted" event.
     */
    public function forceDeleted(PromptRequest $promptRequest): void
    {
        //
    }
}
