<?php

namespace App\Services\Ai\Data;

use Spatie\LaravelData\Data;

class OpenAiCompletionAiModelRequest extends Data
{
    public function __construct(
        public string $model,
        public string $prompt,
        public int $tokens,
        public float $temperature,
    )
    {
        $this->setPromptQuery();
    }

    private function setPromptQuery(): void
    {
        $this->maxTokens = max(($this->tokens - (int) round((strlen($this->prompt)/0.75/2), 0)), 0);
    }

    public function toArray(): array
    {
        return [
            'prompt' => $this->prompt,
            'model' => $this->model,
            'max_tokens'   => $this->maxTokens,
            'temperature' => $this->temperature,
        ];
    }
}
