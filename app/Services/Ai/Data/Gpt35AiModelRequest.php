<?php

namespace App\Services\Ai\Data;

class Gpt35AiModelRequest extends GptAiModelRequest
{
    private const MODEL = 'gpt-3.5-turbo';

    public function __construct(
        public string $request,
    )
    {
        parent::__construct(self::MODEL, $request);
    }
}
