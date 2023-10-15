<?php

namespace App\Services\Ai\Data;

use Spatie\LaravelData\Data;

class Jurassic2LightAiModelRequest extends Jurassic2AiModelRequest
{
    private const MODEL = 'j2-light/complete';
    public function __construct(
        public string $prompt,
    ){
        parent::__construct(self::MODEL, $prompt);
    }
}
