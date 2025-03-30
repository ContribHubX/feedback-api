<?php

namespace App\Services;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function createTask(StoreTaskRequest $request)
    {
        $data = $request->validated();
        $data[Task::USER_ID] = Auth::id();
        return Task::create($data);
    }

    public function updateTask(UpdateTaskRequest $request, Task $existingTask)
    {
        $data = $request->validated();
        $existingTask->update($data);
        return $existingTask;
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
        return $task;
    }

    public function getTask(Task $task)
    {
        return $task;
    }

    public function getTasks() : Collection
    {
        return Task::where(Task::USER_ID, Auth::id())->get();
    }
}

