<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\AgendaController;


Route::get('/', function () {
    return view('welcome');

});

// ROUTE KHUSUS DISPLAY
Route::get('/index', [DisplayController::class, 'index'])->name('index');


//ROUTE KHUSUS URUSAN DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/berita', [DashboardController::class, 'berita'])->name('berita');
Route::get('/agenda', [DashboardController::class, 'agenda'])->name('agenda');
Route::get('/akun', [DashboardController::class, 'akun'])->name('akun');
Route::get('/runningtext', [DashboardController::class, 'runningtext'])->name('runningtext');
Route::get('/video', [DashboardController::class, 'video'])->name('video');

Route::get('/tambahagenda', [DashboardController::class, 'tambahagenda'])->name('tambahagenda');
Route::get('/tambahberita', [DashboardController::class, 'tambahberita'])->name('tambahberita');
Route::get('/editagenda/{id}', [DashboardController::class, 'editagenda'])->name('editagenda');
Route::get('/editberita/{id}', [DashboardController::class, 'editberita'])->name('editberita');

//ROUTE KHUSUS UNTUK POST
Route::post('/simpanVideo', [DashboardController::class, 'simpanVideo'])->name('simpanVideo');
Route::post('/simpanAgenda', [DashboardController::class, 'simpanAgenda'])->name('simpanAgenda');
Route::post('/simpanBerita', [DashboardController::class, 'simpanBerita'])->name('simpanBerita');

//ROUTE KHUSUS MENGHAPUS
Route::delete('/hapusberita/{id}', [DashboardController::class, 'destroyberita'])->name('hapusBerita');
Route::delete('/hapusagenda/{id}', [DashboardController::class, 'destroyagenda'])->name('hapusAgenda');
Route::delete('/hapusvideo/{id}', [DashboardController::class, 'destroyVideo'])->name('hapusVideo');
Route::delete('/hapusrunningtext/{id}', [DashboardController::class, 'destroyRunningtext'])->name('hapusRunningtext');

//ROUTE KHUSUS UPDATE
Route::put('/updateagenda/{id}', [DashboardController::class, 'updateagenda'])->name('updateAgenda');
Route::put('/updateberita/{id}', [DashboardController::class, 'updateberita'])->name('updateBerita');
Route::put('/updatert/{id}', [DashboardController::class, 'updatert'])->name('updateRt');






//KHUSUS BUAT TES/COBA-COBA
// Route::get('/buattes', [DashboardController::class, 'buattes'])->name('buattes');

