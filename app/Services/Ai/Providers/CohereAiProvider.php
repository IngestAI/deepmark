<?php

namespace App\Services\Ai\Providers;

use App\Services\Ai\Enums\AiTextModelEnum;
use App\Services\Ai\Models\AiModel;
use App\Services\Ai\Models\CohereGenerateAiModel;
use App\Services\Ai\Models\CohereSummarizeAiModel;
use App\Services\Ai\Models\NullAiModel;

class CohereAiProvider implements AiProvider
{
    public function model(string $type = ''): AiModel
    {
        switch ($type) {
            case (string) AiTextModelEnum::generate():
                return new CohereGenerateAiModel();
            case (string) AiTextModelEnum::summarize():
                return new CohereSummarizeAiModel();
        }

        return new NullAiModel();
    }
}
