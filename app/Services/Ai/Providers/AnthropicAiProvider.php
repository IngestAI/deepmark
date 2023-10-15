<?php

namespace App\Services\Ai\Providers;

use App\Services\Ai\Enums\AiTextModelEnum;
use App\Services\Ai\Models\AiModel;
use App\Services\Ai\Models\AnthropicAiModel;
use App\Services\Ai\Models\NullAiModel;

class AnthropicAiProvider implements AiProvider
{
    public function model(string $type = ''): AiModel
    {
        switch ($type) {
            case (string) AiTextModelEnum::claudeInstant1_100k():
            case (string) AiTextModelEnum::claudeInstant1():
            case (string) AiTextModelEnum::claude1():
            case (string) AiTextModelEnum::claude2():
                return new AnthropicAiModel();
        }

        return new NullAiModel();
    }
}
