<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;



Route::get('/', function () {
    return view('welcome');

});


Route::get('/index', [DisplayController::class, 'index'])->name('index');
