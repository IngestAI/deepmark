<?php

namespace App\Http\Controllers\Api;

use App\Data\PromptRequestJobData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TaskShowRequest;
use App\Http\Requests\Api\TaskStoreRequest;
use App\Http\Resources\Api\TaskResource;
use App\Http\Resources\Api\TasksResource;
use App\Jobs\PromptRequestJob;
use App\Models\AIModel;
use App\Models\PromptRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TaskShowRequest $request)
    {
        return response()->json([
            'data' => TasksResource::collection(
                Task::all()
            )->toArray($request)
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
    public function show(Task $task, TaskShowRequest $request)
    {
        $data = TaskResource::make($task)->toArray($request);
        return response()->json(['data' => $data]);
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
    public function destroy(Task $task)
    {
        $task->delete();
        response()->json([]);
    }

    public function downloadTask(Task $task)
    {
        $content = implode(';', ['AI Model', 'Answer', 'Latency', 'Error Rate', 'Assessment']);
        foreach ($task->promptRequests as $promptRequest) {
            $content .= "\n" . implode(';', [
                $promptRequest->model->fullname,
                $promptRequest->answer,
                $promptRequest->latency,
                $promptRequest->error_rate_coefficient,
                $promptRequest->assessment_coefficient
            ]);
        }

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="task.csv"',
            'Content-Length' => strlen($content)
        ];

        return response()->make($content, 200, $headers);
    }

    public function downloadModel(Task $task, string $model)
    {
        $model = AIModel::slug($model)->firstOrFail();

        $promptRequests = PromptRequest::where('task_id', $task->id)->where('model_id', $model->id)->get();
        $content = implode(';', ['AI Model', 'Answer', 'Latency', 'Error Rate', 'Assessment']);

        foreach ($promptRequests as $promptRequest) {
            $content .= "\n" . implode(';', [
                    $promptRequest->model->fullname,
                    $promptRequest->answer,
                    $promptRequest->latency,
                    $promptRequest->error_rate_coefficient,
                    $promptRequest->assessment_coefficient
                ]);
        }

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="model.csv"',
            'Content-Length' => strlen($content)
        ];

        return response()->make($content, 200, $headers);
    }
}
