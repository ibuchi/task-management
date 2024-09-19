<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Response::api([
            'data' => Task::all(),
            'message' => 'All tasks!'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        return Response::api([
            'data' => Task::create($request->validated()),
            'message' => 'Task created!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return Response::api([
            'data' => $task,
            'message' => 'Task!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return Response::api([
            'data' => $task,
            'message' => 'Task updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        Response::api('Task deleted!');
    }
}
