<?php

namespace App\Http\Resources\Api;

use App\Enums\PromptRequestStatusEnum;
use App\Enums\PromptRequestConditionEnum;
use App\Enums\TaskStatusEnum;
use App\Models\AIModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid ?? '',
            'prompt' => $this->data['prompt'] ?? '',
            'progress' => (int) $this->progress,
            'downloadAll' => $this->download_url,
            'statistics' => ModelTaskResource::make($this->taskModels),
        ];
    }
}
