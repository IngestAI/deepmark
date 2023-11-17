<?php

namespace App\Models;

use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Task extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'json'
    ];

    protected $fillable = [
        'uuid',
        'status',
        'data',
        'progress'
    ];

    public function promptRequests(): HasMany
    {
        return $this->hasMany(PromptRequest::class)->orderBy('prompt_requests.position');
    }

    public function taskModels(): HasMany
    {
        return $this->hasMany(TaskModel::class);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function (Task $task) {
            $task->uuid = Str::uuid();
            $task->progress = 0;
            $task->status = TaskStatusEnum::waiting()->value;
        });

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('id', 'desc');
        });

        static::deleted(function ($task) {
            $task->promptRequests()->delete();
            $task->taskModels()->delete();
        });
    }

    public function scopeFinished(Builder $query)
    {
        $query->whereIn('status', [
                TaskStatusEnum::suspended(),
                TaskStatusEnum::success(),
                TaskStatusEnum::failed(),
            ]
        );
    }

    public function downloadUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => route('downloadTask', [
                'task' => $this->uuid,
            ], false),
        );
    }
}
