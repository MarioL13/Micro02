<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/persona/{nombre}', function ($nombre) {
    return "hola $nombre";
});
