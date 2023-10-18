<?php

namespace App\Services\ConditionStrategy;

interface ConditionStrategyInterface
{
    public function apply(string $modelAnswer, string $term): bool;
}
