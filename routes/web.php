<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);
Route::resource('projects', ProjectController::class);
Route::resource('items', ItemController::class);
Route::patch('/user/{id}/state', [UserController::class, 'cambiarEstado']);
Route::get('/user/{id_user}/edit', [UserController::class, 'edit']);

