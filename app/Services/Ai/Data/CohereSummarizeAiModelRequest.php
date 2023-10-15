<?php

namespace App\Services\Ai\Data;

use Spatie\LaravelData\Data;

class CohereSummarizeAiModelRequest extends Data
{
    private const MODEL = 'summarize';

    public string $url = 'summarize';

    public function __construct(
        public string $prompt,
        public string $length,
        public string $format,
        public string $extractiveness,
        public float $temperature,
    ){}

    public function toArray(): array
    {
        return [
            'prompt' => $this->prompt,
            'model' => self::MODEL,
            'length' => $this->length,
            'format' => $this->format,
            'extractiveness' => $this->extractiveness,
            'temperarure' => $this->temperature,
        ];
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray());
    }
}
