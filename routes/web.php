<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');

});

//route resource for display
Route::resource('/index', \App\Http\Controllers\DisplayController::class);