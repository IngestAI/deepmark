<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function scopeTask(Builder $query, int $taskId)
    {
        $query->where('task_id', $taskId);
    }

    public function scopeModel(Builder $query, int $modelId)
    {
        $query->where('model_id', $modelId);
    }

    public function match(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (isset($this->data['similarity'])) {
                    return $this->data['similarity'] > 0.9;
                }
                return $this->data['match'] ?? false;
            }
        );
    }

    public function latency(): Attribute
    {
        return Attribute::make(
            get: fn () => !empty($this->data['latency']) ? $this->data['latency'] : 0
        );
    }

    public function errorRate(): Attribute
    {
        return Attribute::make(
            get: fn () => empty($this->data) || !empty($this->data['error']) ? 100 : 0,
        );
    }

    public function assessment(): Attribute
    {
        return Attribute::make(
            get: fn () => !empty($this->match) ? 100 : 0,
        );
    }

    public function errorRateCoefficient(): Attribute
    {
        return Attribute::make(
            get: fn () => !empty($this->error_rate) ? 1 : 0,
        );
    }

    public function assessmentCoefficient(): Attribute
    {
        return Attribute::make(
            get: fn () => !empty($this->assessment) ? 1 : 0,
        );
    }


    public function answer(): Attribute
    {
        return Attribute::make(
            get: fn () => !empty($this->data['answer']) ? $this->data['answer'] : '',
        );
    }
}
