<?php

use App\Http\Controllers\ActivityController;
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
Route::post('/users/import', [UserController::class, 'importCsv'])->name('users.import');
Route::put('/users/{id}/update-photo', [UserController::class, 'updatePhoto'])->name('users.updatePhoto');

Route::resource('projects', ProjectController::class)->middleware('auth');
Route::get('/project/{id}/veralumnos', [ProjectController::class, 'alumnos'])->middleware('auth');
Route::post('/project/{id}/assign-students', [ProjectController::class, 'assignStudents'])->middleware('auth');
Route::get('/project/{id}/edit', [ProjectController::class, 'edit'])->middleware('auth');
Route::get('/project/{id}/veritems', [ProjectController::class, 'items']);
Route::post('/project/{id}/assign-items', [ProjectController::class, 'assignItems'])->middleware('auth');
Route::get('/project/{id}/stats', [ProjectController::class, 'projectStats'])->name('project.stats');
Route::patch('/project/{id}/publicarNotas', [ProjectController::class, 'publicarNotas'])->middleware('auth');

Route::resource('items', ItemController::class)->middleware('auth');
Route::get('/item/{id}/edit', [ItemController::class, 'edit'])->middleware('auth');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/projects/{project}/activities/create', [ActivityController::class, 'create'])->name('activities.create');
Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
Route::get('/activities/{activity}/edit', [ActivityController::class, 'edit'])->name('activities.edit');
Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');
Route::delete('/activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');
Route::get('/activities/{id}/items', [ActivityController::class, 'items'])->name('activities.items');
Route::post('/activities/{id}/items', [ActivityController::class, 'assignItems'])->name('activities.assignItems');
Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('activities.show');
Route::get('/activities/{id}/grade', [ActivityController::class, 'grades'])->name('activities.grade');
Route::post('/activities/{id}/assign-grades', [ActivityController::class, 'assignGrades'])->name('activities.assignGrades');
Route::get('/activities/{id}/stats', [ActivityController::class, 'activityStats'])->name('activities.stats');
