<?php

namespace App\Services\Ai\Data;

use Spatie\LaravelData\Data;

class Jurassic2AiModelRequest extends Data
{
    public function __construct(
        public string $url,
        public string $prompt,
    ){

    }

    public function toArray(): array
    {
        return [
            'prompt' => $this->prompt
        ];
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray());
    }
}
