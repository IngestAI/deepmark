<?php

namespace App\Services\Ai\Conditions;

use App\Enums\PromptRequestConditionEnum;

class ConditionStrategyContext
{
    public static function make(string $condition): ConditionStrategyInterface
    {
        return match ($condition) {
            (string) PromptRequestConditionEnum::equal() => new EqualConditionStrategy(),
            (string) PromptRequestConditionEnum::notEqual() => new NotEqualConditionStrategy(),
            (string) PromptRequestConditionEnum::notContains() => new NotContainsConditionStrategy(),
            (string) PromptRequestConditionEnum::contains() => new ContainsConditionStrategy(),
            (string) PromptRequestConditionEnum::smallerThan() => new SmallerThenConditionStrategy(),
            (string) PromptRequestConditionEnum::biggerThan() => new BiggerThenConditionStrategy(),
            (string) PromptRequestConditionEnum::vectorSimilarity() => new VectorSimilarityConditionStrategy(),
            default => new NullConditionStrategy(),
        };
    }
}
