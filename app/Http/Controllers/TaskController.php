<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TodoList;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\StoreTaskRequest;

use function PHPUnit\Framework\isEmpty;
use App\Http\Requests\UpdateTaskRequest;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TodoList $todo_list)
    {
        $tasks = $todo_list->tasks;
        if ($tasks->isEmpty()) {
            return response()->json(['message' => 'No task data'], Response::HTTP_NOT_FOUND);
        }
        return $tasks;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request, TodoList $todo_list)
    {
        return $todo_list->tasks()->create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        return tap($task)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'The task is successfully deleted'], 204);
    }
}