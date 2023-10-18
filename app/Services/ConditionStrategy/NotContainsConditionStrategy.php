<?php

namespace App\Services\ConditionStrategy;

class NotContainsConditionStrategy implements ConditionStrategyInterface
{
    public function apply(string $modelAnswer, string $term): bool
    {
        return str_contains($modelAnswer, $term) === false;
    }
}
