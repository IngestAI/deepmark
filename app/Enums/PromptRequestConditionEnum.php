<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self equal()
 * @method static self notEqual()
 * @method static self contains()
 * @method static self notContains()
 * @method static self smallerThan()
 * @method static self biggerThan()
 * @method static self vectorSimilarity()
 */
final class PromptRequestConditionEnum extends Enum
{
    protected static function labels()
    {
        return [
            'equal' => 'Is equal to',
            'notEqual' => 'Is not equal to',
            'contains' => 'Output contains a phrase',
            'notContains' => 'Output does not contains a phrase',
            'smallerThan' => 'Output length is smaller than',
            'biggerThan' => 'Output length is bigger than',
            'vectorSimilarity' => 'Vector similarity to the reference',
        ];
    }
}
