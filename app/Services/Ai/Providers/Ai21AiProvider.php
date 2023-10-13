<?php

namespace App\Services\Ai\Providers;

use App\Services\Ai\Enums\AiTextModelEnum;
use App\Services\Ai\Models\AiModel;
use App\Services\Ai\Models\Jurassic2UltraAiModel;
use App\Services\Ai\Models\NullAiModel;

class Ai21AiProvider implements AiProvider
{
    public function model(string $type = ''): AiModel
    {
        switch ($type) {
            case (string) AiTextModelEnum::jurassic2Ultra():
                return new Jurassic2UltraAiModel();
        }

        return new NullAiModel();
    }
}