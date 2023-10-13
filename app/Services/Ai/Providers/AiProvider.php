<?php

namespace App\Services\Ai\Providers;

use App\Services\Ai\Models\AiModel;

interface AiProvider
{
    public function model(string $type = ''): AiModel;
}