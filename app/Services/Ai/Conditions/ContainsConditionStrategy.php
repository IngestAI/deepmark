<?php

namespace App\Services\Ai\Conditions;

class ContainsConditionStrategy implements ConditionStrategyInterface
{
    public function apply(string $modelAnswer, string $term): bool
    {
        return str_contains($modelAnswer, $term);
    }
}
