<?php

namespace App\Data;

use App\Services\Ai\Data\Ai21SummarizeAiModelRequest;
use App\Services\Ai\Data\Claude1AiModelRequest;
use App\Services\Ai\Data\Claude2AiModelRequest;
use App\Services\Ai\Data\ClaudeInstant100kAiModelRequest;
use App\Services\Ai\Data\ClaudeInstant1AiModelRequest;
use App\Services\Ai\Data\CohereGenerateAiModelRequest;
use App\Services\Ai\Data\CohereSummarizeAiModelRequest;
use App\Services\Ai\Data\Gpt35AiModelRequest;
use App\Services\Ai\Data\Gpt35Turbo16kAiModelRequest;
use App\Services\Ai\Data\Gpt4AiModelRequest;
use App\Services\Ai\Data\Jurassic2LightAiModelRequest;
use App\Services\Ai\Data\Jurassic2MidAiModelRequest;
use App\Services\Ai\Data\Jurassic2UltraAiModelRequest;
use App\Services\Ai\Data\NullAiModelRequest;
use App\Services\Ai\Data\TextAda001AiModelRequest;
use App\Services\Ai\Data\TextBabbage001AiModelRequest;
use App\Services\Ai\Data\TextCurie001AiModelRequest;
use App\Services\Ai\Data\TextDavinci002AiModelRequest;
use App\Services\Ai\Data\TextDavinci003AiModelRequest;
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
            case (string) AiTextModelEnum::textAda001():
                $this->model = new TextAda001AiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::textBabbage001():
                $this->model = new TextBabbage001AiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::textCurie001():
                $this->model = new TextCurie001AiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::textDavinci002():
                $this->model = new TextDavinci002AiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::textDavinci003():
                $this->model = new TextDavinci003AiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::claudeInstant1_100k():
                $this->model = new ClaudeInstant100kAiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::claude2():
                $this->model = new Claude2AiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::claude1():
                $this->model = new Claude1AiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::claudeInstant1():
                $this->model = new ClaudeInstant1AiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::jurassic2Ultra():
                $this->model = new Jurassic2UltraAiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::jurassic2Mid():
                $this->model = new Jurassic2MidAiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::jurassic2Light():
                $this->model = new Jurassic2LightAiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::ai21Summarize():
                $this->model = new Ai21SummarizeAiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::generate():
                $this->model = new CohereGenerateAiModelRequest($this->request);
                break;
            case (string) AiTextModelEnum::summarize():
                $this->model = new CohereSummarizeAiModelRequest($this->request);
                break;
        }
    }
}
