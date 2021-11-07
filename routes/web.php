<?php

use App\Http\Controllers\TasksController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('tasks', TasksController::class)->middleware('auth');
Route::put('tasks/{task}/complete', [TasksController::class, 'complete'])
    ->middleware('auth')
    ->name('tasks.complete');

Route::get('trash', [TasksController::class, 'trash'])
    ->middleware('auth')
    ->name('tasks.trash');

Route::delete('tasks/{task}/delete', function (int $id) {
    return (new TasksController())->deleteTask(Task::withTrashed()->find($id));
})
    ->middleware('auth')
    ->name('tasks.deleteTask');

Route::get('tasks/{task}/restore', function (int $id) {
    return (new TasksController())->restoreTask(Task::withTrashed()->find($id));
})
    ->middleware('auth')
    ->name('tasks.restoreTask');

require __DIR__.'/auth.php';
