<?php

namespace App\Services\ConditionStrategy;

class VectorSimilarityConditionStrategy implements ConditionStrategyInterface
{
    public function apply(string $modelAnswer, string $term): bool
    {
        return true;
    }
}
