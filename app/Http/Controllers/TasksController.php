<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TasksController extends Controller
{
    public function index(): View
    {
        return view('tasks.index', ['tasks' => auth()->user()->tasks()->get()]);
    }

    public function create(): View
    {
        return view('tasks.create');
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        $task = (new Task([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ]));

        $task->user()->associate(auth()->user());
        //gives task to authorised user

        $task->save();

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', ['task' => $task]);
    }

    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $task->update([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ]);
        return redirect()->route('tasks.edit', $task);
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function deleteTask(Task $task): RedirectResponse
    {
        $task->forceDelete();
        return redirect()->route('tasks.index');
    }

    public function complete(Task $task): RedirectResponse
    {
        $task->update([
            'id' => $task->id,
            'completed_at' => $task->completed_at ? null : now()
        ]);
        return redirect()->back();
    }
}
