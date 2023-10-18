<?php

namespace App\Services\ConditionStrategy;

class SmallerThenConditionStrategy implements ConditionStrategyInterface
{
    public function apply(string $modelAnswer, string $term): bool
    {
        return strlen($modelAnswer) < $term;
    }
}
