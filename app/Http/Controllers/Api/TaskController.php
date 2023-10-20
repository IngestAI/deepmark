<?php

namespace App\Http\Controllers\Api;

use App\Data\PromptRequestJobData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TaskStoreRequest;
use App\Http\Resources\Api\TasksResource;
use App\Jobs\PromptRequestJob;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => TasksResource::collection(
                Task::finished()
                    ->orderBy('id', 'desc')
                    ->get()
            )
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $task = Task::create([
            'uuid' => $request->uuid,
            'data' => [
                'prompt' => $request->prompt,
                'models' => $request->models,
                'iterations' => $request->iterations,
                'condition' => $request->condition,
                'term' => $request->term,
            ],
            'progress' => 0
        ]);

        $progress = 0;
        $position = 1;
        for ($i = 1; $i <= $request->iterations; $i++) {
            foreach ($request->models as $model) {
                PromptRequestJob::dispatch(
                    new PromptRequestJobData(
                        $task,
                        $model,
                        $position++,
                        $progress += 100 / (count($request->models) * $request->iterations)
                    )
                );
            }
        }

        return response()->json([
            'uuid' => $task->uuid,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::where('uuid', $id)->first();
        if (!$task) {
            return response()->json(['error' => 'Wrong task ID']);
        }
        return response()->json(['data' => TasksResource::make($task)]);
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
        $task = Task::where('uuid', $id)->first();
        if (!$task) {
            return response()->json(['error' => 'Wrong task ID']);
        }
        $task->delete();
        response()->json([]);
    }
}
