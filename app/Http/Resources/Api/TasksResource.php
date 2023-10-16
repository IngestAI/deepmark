<?php

namespace App\Http\Resources\Api;

use App\Enums\PromptRequestStatusEnum;
use App\Enums\PromptRequestCondition;
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
        $modelSlugs = $this->data['models'] ?? [];
        return [
            'uuid' => $this->uuid ?? '',
            'prompt' => $this->data['prompt'] ?? '',
            'iterations' => $this->data['iterations'] ?? 1,
            'term' => $this->data['term'] ?? 'Pattern phrase',
            'condition' => PromptRequestCondition::from($this->data['condition'] ?? PromptRequestCondition::equal())->label,
            'status' => TaskStatusEnum::from($this->status)->label,
            'progress' => (int) $this->progress,
            'models' => AiModelResource::collection(AIModel::whereIn('slug', $modelSlugs)->get()),
        ];
    }
}
