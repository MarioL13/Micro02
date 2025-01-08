<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome')->middleware('auth');

Route::resource('users', UserController::class)->middleware('auth');
Route::resource('projects', ProjectController::class)->middleware('auth');
Route::resource('items', ItemController::class)->middleware('auth');
Route::patch('/user/{id}/state', [UserController::class, 'cambiarEstado'])->middleware('auth');
Route::get('/user/{id_user}/edit', [UserController::class, 'edit'])->middleware('auth');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

