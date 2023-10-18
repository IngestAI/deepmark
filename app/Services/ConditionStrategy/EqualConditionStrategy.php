<?php

namespace App\Services\ConditionStrategy;

class EqualConditionStrategy implements ConditionStrategyInterface
{
    public function apply(string $modelAnswer, string $term): bool
    {
        return $modelAnswer === $term;
    }
}
