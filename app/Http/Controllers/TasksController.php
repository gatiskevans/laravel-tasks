<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        return view('tasks.index', ['tasks' => Task::all()]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(TaskRequest $request)
    {
        (new Task([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'status' => $request->get('status')
        ]))->save();
        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', ['task' => $task]);
    }

    public function update(TaskRequest $request, Task $task)
    {
        $task->update([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'status' => $request->get('status')
        ]);
        return redirect()->route('tasks.edit', $task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
