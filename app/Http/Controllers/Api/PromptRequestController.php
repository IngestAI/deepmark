<?php

namespace App\Http\Controllers\Api;

use App\Data\PromptRequestJobData;
use App\Http\Controllers\Controller;
use App\Http\Requests\PromptStoreRequest;
use App\Http\Resources\Api\PromptsResource;
use App\Jobs\PromptRequestJob;
use App\Models\PromptRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class PromptRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => PromptsResource::collection(PromptRequest::get())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PromptStoreRequest $request)
    {
        $task = Task::create([
            'uuid' => $request->uuid,
            'data' => [
                'prompt' => $request->prompt,
                'models' => $request->models
            ]
        ]);

        PromptRequestJob::dispatch(
            new PromptRequestJobData(
                $task
            )
        );

        return response()->json([
            'uuid' => $task->uuid,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
