<?php

namespace App\Services\Ai\Data;

use OpenAI\Responses\Chat\CreateResponse;
use Spatie\LaravelData\Data;

class ClaudeInstant100kAiModelRequest extends AnthropicAiModelRequest
{
    private const MODEL = 'claude-instant-1-100k';

    public function __construct(
        public string $request,
    ) {
        parent::__construct(self::MODEL, $request);
    }
}
