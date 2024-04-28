<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');

});

// Route::get('/index', function () {
//     return view('display.index');

// });

// Route::get('/cuaca', function () {
//     return view('cuaca');

// });

use App\Http\Controllers\CuacaController;
use App\Http\Controllers\Api\BeritaController;

// Route dengan namespace displays
Route::namespace('Displays')->group(function () {
    Route::get('/index', [CuacaController::class, 'index'])->name('index');
    Route::get('/index', [BeritaController::class, 'index'])->name('index');
});


