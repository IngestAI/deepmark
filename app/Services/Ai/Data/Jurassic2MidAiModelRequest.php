<?php

namespace App\Services\Ai\Data;


class Jurassic2MidAiModelRequest extends Jurassic2AiModelRequest
{
    private const MODEL = 'j2-mid/complete';
    public function __construct(
        public string $prompt,
    ){
        parent::__construct(self::MODEL, $prompt);
    }
}
