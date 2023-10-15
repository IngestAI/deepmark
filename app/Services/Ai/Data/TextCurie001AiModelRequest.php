<?php

namespace App\Services\Ai\Data;


class TextCurie001AiModelRequest extends OpenAiCompletionAiModelRequest
{
    private const MODEL = 'text-curie-001';
    public function __construct(
        public string $prompt,
        public int $tokens,
        public float $temperature,
    ){
        parent::__construct(self::MODEL, $prompt, $tokens, $temperature);
    }
}
