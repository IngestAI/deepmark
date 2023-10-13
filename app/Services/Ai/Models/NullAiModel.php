<?php

namespace App\Services\Ai\Models;

use App\Services\Ai\Data\NullAiModelResponse;
use Spatie\LaravelData\Data;

class NullAiModel implements AiModel
{
    public function send(Data $request): Data
    {
        return new NullAiModelResponse();
    }
}
