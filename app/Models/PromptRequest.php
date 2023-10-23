<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class PromptRequest extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'json'
    ];

    protected $fillable = [
        'prompt',
        'task_id',
        'model_id',
        'position',
        'status',
    ];

    public function model(): BelongsTo
    {
        return $this->belongsTo(AIModel::class);
    }
}
