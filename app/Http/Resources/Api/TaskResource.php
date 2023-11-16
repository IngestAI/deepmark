<?php

namespace App\Http\Resources\Api;

use App\Enums\PromptRequestStatusEnum;
use App\Enums\PromptRequestConditionEnum;
use App\Enums\TaskStatusEnum;
use App\Models\AIModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (empty($request->scope)) {
            return [
                'uuid' => $this->uuid ?? '',
                'prompt' => $this->data['prompt'] ?? '',
                'iterations' => $this->data['iterations'] ?? 1,
                'term' => $this->data['term'] ?? '',
                'condition' => PromptRequestConditionEnum::from($this->data['condition'] ?? PromptRequestConditionEnum::equal())->label,
                'status' => TaskStatusEnum::from($this->status)->label,
                'progress' => (int) $this->progress,
                'statistics' => ModelTaskResource::make($this->taskModels),
            ];
        }
        $data['uuid'] = $this->uuid ?? '';
        if (in_array('prompt', $request->scope)) {
            $data['prompt'] = $this->data['prompt'] ?? '';
        }
        if (in_array('iterations', $request->scope)) {
            $data['iterations'] = $this->data['iterations'] ?? '';
        }
        if (in_array('term', $request->scope)) {
            $data['term'] = $this->data['term'] ?? '';
        }
        if (in_array('condition', $request->scope)) {
            $data['condition'] = PromptRequestConditionEnum::from($this->data['condition'] ?? PromptRequestConditionEnum::equal())->label;
        }
        if (in_array('status', $request->scope)) {
            $data['status'] = TaskStatusEnum::from($this->status)->label;
        }
        if (in_array('progress', $request->scope)) {
            $data['progress'] = (int) $this->progress;
        }
        if (in_array('iterations', $request->scope)) {
            $data['iterations'] = $this->data['iterations'] ?? 1;
        }
        if (in_array('statistics', $request->scope)) {
            $data['statistics'] = ModelTaskResource::make($this->taskModels);
        }
        return $data;
    }
}
