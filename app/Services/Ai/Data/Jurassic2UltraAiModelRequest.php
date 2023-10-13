<?php

namespace App\Services\Ai\Data;

use Spatie\LaravelData\Data;

class Jurassic2UltraAiModelRequest extends Data
{
    public string $url = 'j2-light/complete';
    public function __construct(
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
