<?php

namespace App\Services\Ai\Data;

interface AiVectorModelResponse
{
    public function isSuccessful(): bool;

    public function getVectors(): array;
}
