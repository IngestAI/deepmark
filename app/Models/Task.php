<?php

namespace App\Models;

use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public static function boot()
    {
        parent::boot();

        self::creating(function (Task $task) {
            $task->uuid = Str::uuid();
            $task->progress = 0;
            $task->status = TaskStatusEnum::waiting()->value;
        });
    }
}
