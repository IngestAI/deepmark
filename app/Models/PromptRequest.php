<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public static function getModelsMatches($taskId, $match = true)
    {
        return self::selectRaw('model_id, COUNT(id) as cnt, JSON_EXTRACT(data, "$.match") as match')
            ->where('task_id', $taskId)
            ->where('match', true)
            ->groupBy('model_id');
    }
}
