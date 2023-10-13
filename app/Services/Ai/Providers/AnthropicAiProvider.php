<?php

namespace App\Services\Ai\Providers;

use App\Services\Ai\Enums\AiTextModelEnum;
use App\Services\Ai\Models\AiModel;
use App\Services\Ai\Models\Claude2AiModel;
use App\Services\Ai\Models\ClaudeInstant100kAiModel;
use App\Services\Ai\Models\NullAiModel;

class AnthropicAiProvider implements AiProvider
{
    public function model(string $type = ''): AiModel
    {
        switch ($type) {
            case (string) AiTextModelEnum::claudeInstant1_100k():
                return new ClaudeInstant100kAiModel();
            case (string) AiTextModelEnum::claude2():
                return new Claude2AiModel();
        }

        return new NullAiModel();
    }
}