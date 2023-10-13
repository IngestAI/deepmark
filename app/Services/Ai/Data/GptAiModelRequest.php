<?php

namespace App\Services\Ai\Data;

use Spatie\LaravelData\Data;

class GptAiModelRequest extends Data
{
    protected const MAX_QUERY_LENGTH = 4000;

    public array $messages = [];

    public function __construct(
        public string $model,
        public string $request,
    )
    {
        $this->setMessages();
    }

    private function setMessages(): void
    {
        $prompt = trim(strip_tags($this->request));

        $messages[] = array('role' => 'user', 'content' => $prompt);
        $messages[] = array('role' => 'system', 'content' => 'You are a helpful assistant.');
        $messages = array_reverse($messages);

        $this->messages = array_reverse($messages);
    }

    public function toArray(): array
    {
        return [
            'model' => $this->model,
            'messages' => $this->messages,
        ];
    }
}
