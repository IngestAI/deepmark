<?php

namespace App\Http\Resources\Api;

use App\Enums\PromptRequestStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromptsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'prompt' => (string) $this->prompt,
            'status' => PromptRequestStatusEnum::from($this->status)->label,
            'position' => (int) $this->position,
        ];
    }
}
