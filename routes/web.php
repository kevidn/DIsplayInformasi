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

// Route dengan namespace displays
Route::namespace('Displays')->group(function () {
    Route::get('/index', [CuacaController::class, 'index'])->name('index');
});


