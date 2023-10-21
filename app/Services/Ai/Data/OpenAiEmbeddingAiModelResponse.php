<?php

namespace App\Services\Ai\Data;

use OpenAI\Responses\Embeddings\CreateResponse;
use Spatie\LaravelData\Data;

class OpenAiEmbeddingAiModelResponse extends Data implements AiModelResponse
{
    public function __construct(
        public CreateResponse $response
    ){}

    public function isSuccessful(): bool
    {
        $id = $this->response->id ?? null;
        return $id > 0;
    }

    public function getAnswer(): string
    {
        return trim($this->response->choices[0]->text ?? '');
    }
}
