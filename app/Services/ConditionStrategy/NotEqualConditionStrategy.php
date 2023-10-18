<?php

namespace App\Services\ConditionStrategy;

class NotEqualConditionStrategy implements ConditionStrategyInterface
{
    public function apply(string $modelAnswer, string $term): bool
    {
        return $modelAnswer !== $term;
    }
}
