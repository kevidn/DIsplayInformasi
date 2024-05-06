<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//beritas
Route::apiResource('/beritas', App\Http\Controllers\Api\BeritaController::class);

//header
Route::apiResource('/header', App\Http\Controllers\Api\HeaderController::class);

//Runingtext
Route::apiResource('/RTs', App\Http\Controllers\Api\RTController::class);

//Video
Route::apiResource('/video', App\Http\Controllers\Api\VIdeoController::class);


//Agenda
Route::apiResource('/Agenda', App\Http\Controllers\Api\AgendaController::class);






