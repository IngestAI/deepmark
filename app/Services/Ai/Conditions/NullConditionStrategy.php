<?php

namespace App\Services\Ai\Conditions;

class NullConditionStrategy implements ConditionStrategyInterface
{
    public function apply(string $modelAnswer, string $term): bool
    {
        return false;
    }
}
