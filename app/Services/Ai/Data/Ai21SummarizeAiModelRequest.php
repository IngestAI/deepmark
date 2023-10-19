<?php

namespace App\Services\Ai\Data;

use Spatie\LaravelData\Data;

class Ai21SummarizeAiModelRequest extends Data
{
    public string $url = 'summarize';

    public function __construct(
        public string $prompt,
        public string $sourceType = 'TEXT',
        public string $focus = '',
    ){}

    public function toArray(): array
    {
        $data = [
            'source' => $this->prompt,
        ];

        if (!empty($this->sourceType)) {
            $data['sourceType'] = $this->sourceType;
        }

        if (!empty($this->focus)) {
            $data['focus'] = $this->focus;
        }

        return $data;
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray());
    }
}
