<?php

namespace App\Services\Ai\Models;

use App\Services\Ai\Data\OpenAiCompletionAiModelResponse;
use OpenAI;
use Spatie\LaravelData\Data;

class OpenAiCompletionAiModel implements AiModel
{
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
    }
    public function send(Data $request): Data
    {
        return new OpenAiCompletionAiModelResponse(
            OpenAI::client($this->apiKey)
                ->completions()
                ->create($request->toArray())
        );
    }
}
