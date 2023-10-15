<?php

namespace App\Services\Ai;

use App\Services\Ai\Enums\AiProviderEnum;
use App\Services\Ai\Providers\Ai21AiProvider;
use App\Services\Ai\Providers\AiProvider;
use App\Services\Ai\Providers\AnthropicAiProvider;
use App\Services\Ai\Providers\CohereAiProvider;
use App\Services\Ai\Providers\NullAiProvider;
use App\Services\Ai\Providers\OpenAiProvider;

final class AiFactory
{
    public static function provider(string $provider = ''): AiProvider
    {
        switch ($provider) {
            case (string) AiProviderEnum::openai():
                return new OpenAiProvider();
            case (string) AiProviderEnum::anthropic():
                return new AnthropicAiProvider();
            case (string) AiProviderEnum::ai21():
                return new Ai21AiProvider();
            case (string) AiProviderEnum::cohere():
                return new CohereAiProvider();
        }

        return new NullAiProvider();
    }
}
