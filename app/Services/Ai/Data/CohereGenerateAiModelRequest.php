<?php

namespace App\Services\Ai\Data;

use Spatie\LaravelData\Data;

class CohereGenerateAiModelRequest extends Data
{
    private const MODEL = 'command-xlarge-nightly';

    public string $url = 'generate';

    public function __construct(
        public string $prompt,
        public int $maxTokens = 300,
        public string $likelihoods = 'NONE',
        public string $truncate = '',
    ){}

    public function toArray(): array
    {
        return [
            'prompt' => $this->prompt,
            'model' => self::MODEL,
            'max_tokens' => $this->maxTokens,
            'return_likelihoods' => $this->likelihoods,
            'truncate' => $this->truncate,
        ];
    }
}
