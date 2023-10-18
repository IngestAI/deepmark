<?php

namespace App\Services\Ai\Conditions;

class VectorSimilarityConditionStrategy implements ConditionStrategyInterface
{
    public function apply(string $modelAnswer, string $term): bool
    {
        return true;
    }
}
