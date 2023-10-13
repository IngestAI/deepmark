<?php

namespace App\Data;

use App\Services\Ai\Data\Claude2AiModelRequest;
use App\Services\Ai\Data\ClaudeInstant100kAiModelRequest;
use App\Services\Ai\Data\Gpt35AiModelRequest;
use App\Services\Ai\Data\Gpt35Turbo16kAiModelRequest;
use App\Services\Ai\Data\Gpt4AiModelRequest;
use App\Services\Ai\Data\Jurassic2UltraAiModelRequest;
use App\Services\Ai\Data\NullAiModelRequest;
use App\Services\Ai\Enums\AiTextModelEnum;
use Spatie\LaravelData\Data;

class QueryAiModelRequest extends Data
{
    public Data $model;

    public array $messages = [];

    public function __construct(
        public string $slug,
        public string $request,
    )
    {
        $this->selectModel();
    }

    private function selectModel(): void
    {
        $this->model = new NullAiModelRequest();
        switch ($this->slug) {
            case (string) AiTextModelEnum::gpt3_5():
                $this->model = new Gpt35AiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::gpt4():
                $this->model = new Gpt4AiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::gpt3_5Turbo16k():
                $this->model = new Gpt35Turbo16kAiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::claudeInstant1_100k():
                $this->model = new ClaudeInstant100kAiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::claude2():
                $this->model = new Claude2AiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::jurassic2Ultra():
                $this->model = new Jurassic2UltraAiModelRequest($this->request);
                break;
        }
    }
}
