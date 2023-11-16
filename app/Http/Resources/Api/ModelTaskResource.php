<?php

namespace App\Http\Resources\Api;

use App\Models\PromptRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ModelTaskResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(
            fn($taskModel) => [
                'id' => $taskModel->id,
                'model' => $taskModel->model->fullname,
                'latency' => $taskModel->latency,
                'errorRate' => $taskModel->error_rate,
                'assessment' => $taskModel->assessment,
                'downloadUrl' => $taskModel->download_url,
                'answers' => PromptRequest::task($taskModel->task_id)->model($taskModel->model_id)->get()
                    ->map(fn($promptRequest) => $promptRequest->answer),
            ],
        )->all();
    }
}
