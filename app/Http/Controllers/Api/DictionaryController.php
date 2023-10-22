<?php

namespace App\Http\Controllers\Api;

use App\Enums\PromptRequestConditionEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ModelsResource;
use App\Models\AIModel;

class DictionaryController extends Controller
{
    public function models()
    {
        return response()->json([
            'data' => ModelsResource::make(AIModel::text()->get())
        ]);
    }

    public function conditions()
    {
        return response()->json([
            'data' => array_map(
                fn($value, $title) => [
                    'value' => $value,
                    'title' => $title
                ],
                PromptRequestConditionEnum::toValues(),
                PromptRequestConditionEnum::toLabels(),
            )
        ]);
    }
}
