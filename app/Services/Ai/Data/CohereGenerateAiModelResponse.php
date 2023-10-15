<?php

namespace App\Services\Ai\Data;

use Spatie\LaravelData\Data;

class CohereGenerateAiModelResponse extends Data implements AiModelResponse
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
        return trim($this->response['generations'][0]['text'] ?? '');
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->response);
    }
}
