<?php

namespace App\Services\Ai\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self openai()
 * @method static self anthropic()
 * @method static self ai21()
 * @method static self amazon()
 * @method static self cohere()
 * @method static self ingestai()
 */
final class AiProviderEnum extends Enum
{
}
