<?php

namespace App\Models;

use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Task extends Model
{
    use HasFactory, SoftDeletes;

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

    public static function boot()
    {
        parent::boot();

        self::creating(function (Task $task) {
            $task->uuid = Str::uuid();
            $task->progress = 0;
            $task->status = TaskStatusEnum::waiting()->value;
        });

        static::deleted(function ($task) {
            $task->promptRequests()->delete();
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
}
