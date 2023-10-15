<?php

namespace App\Services\Ai\Data;


class TextAda001AiModelRequest extends OpenAiCompletionAiModelRequest
{
    private const MODEL = 'text-ada-001';
    public function __construct(
        public string $prompt,
        public int $tokens,
        public float $temperature,
    ){
        parent::__construct(self::MODEL, $prompt, $tokens, $temperature);
    }
}
