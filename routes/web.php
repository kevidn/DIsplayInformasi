<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');

});


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
Route::get('/editagenda', [DashboardController::class, 'editagenda'])->name('editagenda');
Route::get('/editberita', [DashboardController::class, 'editberita'])->name('editberita');

//KHUSUS BUAT TES/COBA-COBA
// Route::get('/buattes', [DashboardController::class, 'buattes'])->name('buattes');


Auth::routes();

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
  
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
  
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});


//LOGOUT
Route::post('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');