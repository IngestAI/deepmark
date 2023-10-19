<?php

namespace App\Services\Ai\Data;

class Gpt35Turbo16kAiModelRequest extends GptAiModelRequest
{
    private const MODEL = 'gpt-3.5-turbo-16k';

    public function __construct(
        public string $request,
    )
    {
        parent::__construct(self::MODEL, $request);
    }
}
