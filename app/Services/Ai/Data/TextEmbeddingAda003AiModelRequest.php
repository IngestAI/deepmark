<?php

namespace App\Services\Ai\Data;

use Spatie\LaravelData\Data;

class TextEmbeddingAda003AiModelRequest extends Data
{
    public string $model = 'text-embedding-ada-002';
    public function __construct(
        public string $prompt,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'model' => $this->model,
            'input' => $this->prompt,
        ];
    }
}
