<?php

namespace App\Services\Ai\Models;

use Spatie\LaravelData\Data;

interface AiModel
{
    public function send(Data $request): Data;
}