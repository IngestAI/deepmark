<?php

namespace App\Services\Ai\Data;

use OpenAI\Responses\Chat\CreateResponse;
use Spatie\LaravelData\Data;

class AnthropicAiModelResponse extends Data implements AiModelResponse
{
    public function __construct(
        public array $response
    ) {}

    public function isSuccessful(): bool
    {
        return !empty($this->response['log_id']);
    }

    public function getAnswer(): string
    {
        return trim($this->response['completion'] ?? '');
    }
}
