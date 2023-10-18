<?php

namespace App\Http\Resources\Api;

use App\Enums\PromptRequestStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromptRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'query' =>  $this->prompt,
            'answer' =>  $this->data['answer'] ?? '',
            'status' => PromptRequestStatusEnum::from($this->status)->label,
            'model' => ModelResource::make($this->model),
        ];
    }
}
