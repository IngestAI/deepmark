<?php

namespace App\Services\Ai\Models;

use App\Services\Ai\Data\GptAiModelResponse;
use OpenAI;
use Spatie\LaravelData\Data;

class GptAiModel implements AiModel
{
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
    }
    public function send(Data $request): Data
    {
        return new GptAiModelResponse(
            OpenAI::client($this->apiKey)
                ->chat()
                ->create($request->toArray())
        );
    }
}
