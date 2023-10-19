<?php

namespace App\Services\Ai\Data;

use Spatie\LaravelData\Data;

class Jurassic2AiModelResponse extends Data implements AiModelResponse
{
    public function __construct(
        public array $response
    ) {}

    public function isSuccessful(): bool
    {
        return !empty($this->response['id']);
    }

    public function getAnswer(): string
    {
        return trim($this->response['prompt']['text'] ?? '');
    }
}
