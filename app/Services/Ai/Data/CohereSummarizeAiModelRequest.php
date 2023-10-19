<?php

namespace App\Services\Ai\Data;

use Spatie\LaravelData\Data;

class CohereSummarizeAiModelRequest extends Data
{
    private const MODEL = 'summarize-xlarge';

    public string $url = 'summarize';

    public function __construct(
        public string $prompt,
        public string $length = 'auto',
        public string $format = 'paragraph',
        public string $extractiveness = 'low',
        public float $temperature = 0.3,
    ){}

    public function toArray(): array
    {
        return [
            'text' => $this->prompt,
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
