<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;

Route::get('/', [ProjectController::class, 'index'])->name('projects.index')->middleware('auth');


Route::get('/welcome', function () {
    return redirect()->route('projects.index');
})->name('welcome');

Route::resource('users', UserController::class)->middleware('auth');
Route::patch('/user/{id}/state', [UserController::class, 'cambiarEstado'])->middleware('auth');
Route::get('/user/{id_user}/edit', [UserController::class, 'edit'])->middleware('auth');

Route::resource('projects', ProjectController::class)->middleware('auth');
Route::get('/project/{id}/veralumnos', [ProjectController::class, 'alumnos'])->middleware('auth');
Route::post('/project/{id}/assign-students', [ProjectController::class, 'assignStudents'])->middleware('auth');
Route::get('/project/{id}/edit', [ProjectController::class, 'edit'])->middleware('auth');
Route::get('/project/{id}/veritems', [ProjectController::class, 'items']);
Route::post('/project/{id}/assign-items', [ProjectController::class, 'assignItems'])->middleware('auth');

Route::resource('items', ItemController::class)->middleware('auth');
Route::get('/item/{id}/edit', [ItemController::class, 'edit'])->middleware('auth');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

