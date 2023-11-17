<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function scopeTask(Builder $query, int $taskId)
    {
        $query->where('task_id', $taskId);
    }

    public function scopeModel(Builder $query, int $modelId)
    {
        $query->where('model_id', $modelId);
    }

    public function assessment(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->match['assessment'] ?? 0,
        );
    }

    public function latency(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->match['latency'] ?? 0,
        );
    }

    public function errorRate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->match['error_rate'] ?? 0,
        );
    }

    public function downloadUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => route('downloadModel', [
                'model' => $this->model->slug,
                'task' => $this->task->uuid,
            ], false),
        );
    }
}
