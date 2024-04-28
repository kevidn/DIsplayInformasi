<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\Api\BeritaController;


Route::get('/', function () {
    return view('welcome');

});


Route::get('/index', [DisplayController::class, 'index'])->name('index');
Route::get('/index', [BeritaController::class, 'index'])->name('index');