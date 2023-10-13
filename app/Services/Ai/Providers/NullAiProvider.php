<?php

namespace App\Services\Ai\Providers;

use App\Services\Ai\Models\AiModel;
use App\Services\Ai\Models\NullAiModel;

class NullAiProvider implements AiProvider
{
    public function model(string $type = ''): AiModel
    {
        return new NullAiModel();
    }
}
