<?php

namespace App\Services\Ai\Conditions;

class NotEqualConditionStrategy implements ConditionStrategyInterface
{
    public function apply(string $modelAnswer, string $term): bool
    {
        return $modelAnswer !== $term;
    }
}
