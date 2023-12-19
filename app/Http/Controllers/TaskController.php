<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskFormRequest;
use App\Http\Resources\TasksResource;
use App\Models\Task;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    use HttpResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TasksResource::collection(Task::where('user_id', auth()->user()->id)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskFormRequest $request)
    {
        $task = Task::create(
            ['user_id' => Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'priority' => $request->priority,
            ]
        );
        return new TasksResource($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return $this->isNotAuthorized($task) ? $this->isNotAuthorized($task) : new TasksResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if (Auth::user()->id != $task->user_id) {
            return $this->error('', 'Forbidden Access', 403);
        }
        $task->update($request->all());
        return new TasksResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        return $this->isNotAuthorized($task) ? $this->isNotAuthorized($task) : $task->delete();
    }

    private function isNotAuthorized(Task $task)
    {
        if (Auth::user()->id != $task->user_id) {
            return $this->error('', 'Forbidden Access', 403);
        }
    }
}
