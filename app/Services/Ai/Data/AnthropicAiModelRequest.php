<?php

namespace App\Services\Ai\Data;

use OpenAI\Responses\Chat\CreateResponse;
use Spatie\LaravelData\Data;

class AnthropicAiModelRequest extends Data
{
    protected const MAX_TOKENS = 1024;

    protected string $prompt = '';

    public function __construct(
        public string $model,
        public string $request,
    ) {
        $this->prompt = "\n\nHuman: " . $request
            . "\n\nAssistant:";
    }

    public function toArray(): array
    {
        return [
            'prompt' => $this->prompt,
            'model' => $this->model,
            'max_tokens_to_sample' => self::MAX_TOKENS,
        ];
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray());
    }
}
