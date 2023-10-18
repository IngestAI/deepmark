<?php

namespace App\Services\Ai\Conditions;

interface ConditionStrategyInterface
{
    public function apply(string $modelAnswer, string $term): bool;
}
