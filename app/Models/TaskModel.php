<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskModel extends Model
{
    use HasFactory;

    protected $casts = [
        'match' => 'json'
    ];

    protected $fillable = [
        'task_id',
        'model_id',
        'match',
    ];

    public function model(): BelongsTo
    {
        return $this->belongsTo(AIModel::class);
    }
}
