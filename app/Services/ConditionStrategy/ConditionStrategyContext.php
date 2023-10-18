<?php

namespace App\Services\ConditionStrategy;

use App\Enums\PromptRequestConditionEnum;

class ConditionStrategyContext
{
    private ConditionStrategyInterface $conditionStrategy;

    public function __construct(string $condition)
    {
        $this->conditionStrategy = match ($condition) {
            (string) PromptRequestConditionEnum::equal() => new EqualConditionStrategy(),
            (string) PromptRequestConditionEnum::notEqual() => new NotEqualConditionStrategy(),
            (string) PromptRequestConditionEnum::notContains() => new NotContainsConditionStrategy(),
            (string) PromptRequestConditionEnum::contains() => new ContainsConditionStrategy(),
            (string) PromptRequestConditionEnum::smallerThan() => new SmallerThenConditionStrategy(),
            (string) PromptRequestConditionEnum::biggerThan() => new BiggerThenConditionStrategy(),
            (string) PromptRequestConditionEnum::vectorSimilarity() => new VectorSimilarityConditionStrategy(),
            default => throw new \RuntimeException('Undefined Strategy'),
        };
    }

    public function checkCondition(string $modelAnswer, string $term): bool
    {
        return $this->conditionStrategy->apply($modelAnswer, $term);
    }
}
