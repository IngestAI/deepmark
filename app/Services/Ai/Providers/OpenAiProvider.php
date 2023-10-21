<?php

namespace App\Services\Ai\Providers;

use App\Services\Ai\Enums\AiTextModelEnum;
use App\Services\Ai\Enums\AiVectorModelEnum;
use App\Services\Ai\Models\AiModel;
use App\Services\Ai\Models\GptAiModel;
use App\Services\Ai\Models\NullAiModel;
use App\Services\Ai\Models\OpenAiCompletionAiModel;
use App\Services\Ai\Models\OpenAiEmbeddingAiModel;

class OpenAiProvider implements AiProvider
{
    public function model(string $type = ''): AiModel
    {
        switch ($type) {
            case (string) AiTextModelEnum::gpt3_5():
            case (string) AiTextModelEnum::gpt4():
            case (string) AiTextModelEnum::gpt3_5Turbo16k():
                return new GptAiModel();
            case (string) AiTextModelEnum::textAda001():
            case (string) AiTextModelEnum::textBabbage001():
            case (string) AiTextModelEnum::textCurie001():
            case (string) AiTextModelEnum::textDavinci002():
            case (string) AiTextModelEnum::textDavinci003():
                return new OpenAiCompletionAiModel();
            case (string) AiVectorModelEnum::textEmbeddingAda002():
                return new OpenAiEmbeddingAiModel();
        }

        return new NullAiModel();
    }
}
