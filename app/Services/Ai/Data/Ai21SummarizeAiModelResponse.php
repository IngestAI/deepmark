<?php

namespace App\Services\Ai\Data;

use Spatie\LaravelData\Data;

class Ai21SummarizeAiModelResponse extends Data implements AiModelResponse
{
    public function __construct(
        public array $response
    ){}

    public function isSuccessful(): bool
    {
        return !empty($this->response['id']);
    }

    public function getAnswer(): string
    {
        return trim($this->response['summary'] ?? '');
    }

    public function getTotalTokens(): int
    {
        return 0;
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->response);
    }
}
