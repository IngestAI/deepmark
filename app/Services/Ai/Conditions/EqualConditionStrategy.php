<?php

namespace App\Services\Ai\Conditions;

class EqualConditionStrategy implements ConditionStrategyInterface
{
    public function apply(string $modelAnswer, string $term): bool
    {
        return $modelAnswer === $term;
    }
}
