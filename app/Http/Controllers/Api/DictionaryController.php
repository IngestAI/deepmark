<?php

namespace App\Http\Controllers\Api;

use App\Enums\PromptRequestConditionEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AiModelResource;
use App\Models\AIModel;

class DictionaryController extends Controller
{
    public function models()
    {
        return response()->json([
            'data' => AiModelResource::make(AIModel::all())
        ]);
    }

    public function conditions()
    {
        return response()->json([
            'data' => PromptRequestConditionEnum::toArray()
        ]);
    }
}
