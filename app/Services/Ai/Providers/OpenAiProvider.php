<?php

namespace App\Services\Ai\Providers;

use App\Services\Ai\Enums\AiTextModelEnum;
use App\Services\Ai\Models\AiModel;
use App\Services\Ai\Models\Gpt35AiModel;
use App\Services\Ai\Models\Gpt35Turbo16kAiModel;
use App\Services\Ai\Models\Gpt4AiModel;
use App\Services\Ai\Models\NullAiModel;

class OpenAiProvider implements AiProvider
{
    public function model(string $type = ''): AiModel
    {
        switch ($type) {
            case (string) AiTextModelEnum::gpt3_5():
                return new Gpt35AiModel();
            case (string) AiTextModelEnum::gpt4():
                return new Gpt4AiModel();
            case (string) AiTextModelEnum::gpt3_5Turbo16k():
                return new Gpt35Turbo16kAiModel();
        }

        return new NullAiModel();
    }
}
