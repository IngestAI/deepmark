<?php

namespace App\Services\Ai\Data;

class Gpt4AiModelRequest extends GptAiModelRequest
{
    private const MODEL = 'gpt-4';

    public function __construct(
        public string $request,
    )
    {
        parent::__construct(self::MODEL, $request);
    }
}
