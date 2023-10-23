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
        $modelSlugs = $this->data['models'] ?? [];
        if (empty($request->scope)) {
            return [
                'uuid' => $this->uuid ?? '',
                'prompt' => $this->data['prompt'] ?? '',
                'iterations' => $this->data['iterations'] ?? 1,
                'term' => $this->data['term'] ?? '',
                'condition' => PromptRequestConditionEnum::from($this->data['condition'] ?? PromptRequestConditionEnum::equal())->label,
                'status' => TaskStatusEnum::from($this->status)->label,
                'progress' => (int) $this->progress,
                'models' => ModelTaskResource::make(AIModel::whereIn('slug', $modelSlugs)->get()),
                'responses' => PromptRequestResource::collection($this->promptRequests),
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
            $data['iterations'] = ModelTaskResource::make(AIModel::whereIn('slug', $modelSlugs)->get());
        }
        if (in_array('responses', $request->scope)) {
            $data['responses'] = PromptRequestResource::collection($this->promptRequests);
        }
        return $data;
    }
}
