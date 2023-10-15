<?php

namespace App\Services\Ai\Data;


class TextAda001AiModelRequest extends OpenAiCompletionAiModelRequest
{
    private const MODEL = 'text-ada-001';
    public function __construct(
        public string $prompt,
        public int $tokens = 1024,
        public float $temperature = 0.7,
    ){
        parent::__construct(self::MODEL, $prompt, $tokens, $temperature);
    }
}
