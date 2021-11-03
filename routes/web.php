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
Route::post('tasks/{task}/complete', [TasksController::class, 'complete'])
    ->middleware('auth')
    ->name('tasks.complete');

require __DIR__.'/auth.php';
