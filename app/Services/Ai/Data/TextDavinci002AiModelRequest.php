<?php

namespace App\Services\Ai\Data;


class TextDavinci002AiModelRequest extends OpenAiCompletionAiModelRequest
{
    private const MODEL = 'text-davinci-002';
    public function __construct(
        public string $prompt,
        public int $tokens = 1024,
        public float $temperature = 0.7,
    ){
        parent::__construct(self::MODEL, $prompt, $tokens, $temperature);
    }
}
