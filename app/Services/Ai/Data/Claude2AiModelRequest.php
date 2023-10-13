<?php

namespace App\Services\Ai\Data;

use OpenAI\Responses\Chat\CreateResponse;
use Spatie\LaravelData\Data;

class Claude2AiModelRequest extends AnthropicAiModelRequest
{
    private const MODEL = 'claude-2';

    public function __construct(
        public string $request,
    ) {
        parent::__construct(self::MODEL, $request);
    }
}
