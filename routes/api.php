<?php

use App\Http\Controllers\Api\DictionaryController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'api.bearerToken'], function () {
    Route::apiResource('/tasks', TaskController::class);
    Route::get('/models', [DictionaryController::class, 'models']);
    Route::get('/conditions', [DictionaryController::class, 'conditions']);
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found.'
    ], 404);
});





