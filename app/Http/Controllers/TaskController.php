<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService) {
        $this->taskService = $taskService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = $this->taskService->getTasks();
        return response()->json([
            'tasks' => $tasks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        Gate::authorize('create', Task::class);
        return response()->json(
            $this->taskService->createTask($request)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        Gate::authorize('view', $task);
        return response()->json(
            $this->taskService->getTask($task)
        );
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        Gate::authorize('update', $task);
        $updatedTask = $this->taskService->updateTask($request, $task);
        return response()->json(
            $updatedTask
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);
        $deletedTask = $this->taskService->deleteTask($task);
        return response()->json($deletedTask);
    }
}
