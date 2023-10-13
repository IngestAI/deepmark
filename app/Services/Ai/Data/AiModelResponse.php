<?php

namespace App\Services\Ai\Data;

interface AiModelResponse
{
    public function isSuccessful(): bool;

    public function getAnswer(): string;
}