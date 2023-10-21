<?php

namespace App\Services\Ai\Models;

use App\Services\Ai\Data\OpenAiEmbeddingAiModelResponse;
use OpenAI;
use Spatie\LaravelData\Data;

class OpenAiEmbeddingAiModel implements AiModel
{
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
    }
    public function send(Data $request): Data
    {
        return new OpenAiEmbeddingAiModelResponse(
            OpenAI::client($this->apiKey)
                ->embeddings()
                ->create($request->toArray())
        );
    }
}
