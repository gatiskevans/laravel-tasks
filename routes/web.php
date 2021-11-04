<?php

use App\Http\Controllers\TasksController;
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

Route::delete('tasks', [TasksController::class, 'deleteTask'])
    ->middleware('auth')
    ->name('tasks.deleteTask');

require __DIR__.'/auth.php';
