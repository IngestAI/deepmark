<?php

namespace App\Services\Ai\Providers;

use App\Services\Ai\Enums\AiTextModelEnum;
use App\Services\Ai\Models\Ai21SummarizeAiModel;
use App\Services\Ai\Models\AiModel;
use App\Services\Ai\Models\Jurassic2AiModel;
use App\Services\Ai\Models\NullAiModel;

class Ai21AiProvider implements AiProvider
{
    public function model(string $type = ''): AiModel
    {
        switch ($type) {
            case (string) AiTextModelEnum::jurassic2Ultra():
            case (string) AiTextModelEnum::jurassic2Mid():
            case (string) AiTextModelEnum::jurassic2Light():
                return new Jurassic2AiModel();
            case (string) AiTextModelEnum::ai21Summarize():
                return new Ai21SummarizeAiModel();
        }

        return new NullAiModel();
    }
}
