<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self waiting()
 * @method static self running()
 * @method static self suspended()
 * @method static self success()
 * @method static self failed()
 */
final class TaskStatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'waiting' => 1,
            'running' => 2,
            'suspended' => 3,
            'success' => 4,
            'failed' => 5
        ];
    }

    protected static function labels(): array
    {
        return [
            'waiting' => 'Waiting',
            'running' => 'Running',
            'suspended' => 'Suspended',
            'success' => 'Success',
            'failed' => 'Failed',
        ];
    }
}
