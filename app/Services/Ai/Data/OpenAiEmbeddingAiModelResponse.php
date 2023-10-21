<?php

namespace App\Services\Ai\Data;

use OpenAI\Responses\Embeddings\CreateResponse;
use Spatie\LaravelData\Data;

class OpenAiEmbeddingAiModelResponse extends Data implements AiVectorModelResponse
{
    public function __construct(
        public CreateResponse $response
    ){}

    public function isSuccessful(): bool
    {
        $embeddings = $this->response->embeddings[0]->embedding ?? [];
        return !empty($embeddings);
    }

    public function getVectors(): array
    {
        return $this->response->embeddings[0]->embedding ?? [];
    }
}
