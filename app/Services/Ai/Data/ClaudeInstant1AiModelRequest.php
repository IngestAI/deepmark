<?php

namespace App\Services\Ai\Data;

use OpenAI\Responses\Chat\CreateResponse;
use Spatie\LaravelData\Data;

class ClaudeInstant1AiModelRequest extends AnthropicAiModelRequest
{
    private const MODEL = 'claude-instant-1';

    public function __construct(
        public string $request,
    ) {
        parent::__construct(self::MODEL, $request);
    }
}
