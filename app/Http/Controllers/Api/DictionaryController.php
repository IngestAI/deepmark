<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AiModelResource;
use App\Models\AIModel;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function models()
    {
        return response()->json([
            'data' => AiModelResource::collection(AIModel::get())
        ]);
    }
}
