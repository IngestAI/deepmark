<?php

namespace App\Data;

use App\Models\Task;
use Spatie\LaravelData\Data;

class PromptRequestJobData extends Data
{
    public function __construct(
        public Task $task
    ) {}
}
