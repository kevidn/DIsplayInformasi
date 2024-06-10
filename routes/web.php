<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use app\Http\Middleware\UnregisteredUser;
use App\Http\Controllers\Api\AgendaController;


// Route::get('/', function () {
//     return view('welcome');

// });




// ROUTE KHUSUS DISPLAY
Route::get('/index', [DisplayController::class, 'index'])->name('index');
Route::get('/mobile-view', [DisplayController::class, 'showMobileView'])->name('showMobileView');





//ROUTE KHUSUS URUSAN DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/berita', [DashboardController::class, 'berita'])->name('berita');
Route::get('/agenda', [DashboardController::class, 'agenda'])->name('agenda');
Route::get('/akun', [DashboardController::class, 'akun'])->name('akun');
Route::get('/runningtext', [DashboardController::class, 'runningtext'])->name('runningtext');
Route::get('/video', [DashboardController::class, 'video'])->name('video');
Route::get('/slideinformation', [DashboardController::class, 'slideinformation'])->name('slideinformation');



Route::get('/tambahagenda', [DashboardController::class, 'tambahagenda'])->name('tambahagenda');
Route::get('/tambahberita', [DashboardController::class, 'tambahberita'])->name('tambahberita');
Route::get('/editagenda/{id}', [DashboardController::class, 'editagenda'])->name('editagenda');
Route::get('/editberita/{id}', [DashboardController::class, 'editberita'])->name('editberita');
Route::post('/ubahlevel/{id}/{newLevel}', [DashboardController::class, 'ubahLevelAkun'])->name('ubahlevel');

//ROUTE KHUSUS UNTUK POST
Route::post('/simpanVideo', [DashboardController::class, 'simpanVideo'])->name('simpanVideo');
Route::post('/simpanVideolokal', [DashboardController::class, 'simpanVideolokal'])->name('simpanVideolokal');
Route::post('/simpanAgenda', [DashboardController::class, 'simpanAgenda'])->name('simpanAgenda');
Route::post('/simpanBerita', [DashboardController::class, 'simpanBerita'])->name('simpanBerita');
Route::post('/create-user-account', [DashboardController::class, 'createUserAccount'])->name('create.user.account');







//ROUTE KHUSUS MENGHAPUS
Route::delete('/hapusberita/{id}', [DashboardController::class, 'destroyberita'])->name('hapusBerita');
Route::delete('/hapusagenda/{id}', [DashboardController::class, 'destroyagenda'])->name('hapusAgenda');
Route::delete('/hapusvideo/{id}', [DashboardController::class, 'destroyVideo'])->name('hapusVideo');
Route::delete('/hapusRT/{id}', [DashboardController::class, 'destroyRT'])->name('hapusRT');
Route::delete('/hapus-quotes/{id}', [DashboardController::class, 'hapusQuotes'])->name('hapusQuotes');
Route::delete('/hapusgambarslide/{id}', [DashboardController::class, 'deleteImage'])->name('hapusgambarslide');



//ROUTE KHUSUS UPDATE
Route::put('/updateagenda/{id}', [DashboardController::class, 'updateagenda'])->name('updateAgenda');
Route::put('/updateberita/{id}', [DashboardController::class, 'updateberita'])->name('updateBerita');
Route::put('/updatert/{id}', [DashboardController::class, 'updatert'])->name('updateRt');
Route::put('/updatequotes/{id}', [DashboardController::class, 'updateQuotes'])->name('updateQuotes');
Route::put('/updategambarslide/{id}', [DashboardController::class, 'updateImage'])->name('updategambarslide');
Route::post('/tampilkan-video-ke-display/{id}', [DashboardController::class, 'updateTampilStatus'])->name('tampilkanVideoKeDisplay');
Route::post('/hapus-video-ke-display/{id}', [DashboardController::class, 'hapusTampilStatus'])->name('hapusVideoKeDisplay');












Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/berita', [DashboardController::class, 'berita'])->name('berita');

    Route::get('/agenda', [DashboardController::class, 'agenda'])->name('agenda');

    Route::get('/runningtext', [DashboardController::class, 'runningtext'])->name('runningtext');

    Route::get('/video', [DashboardController::class, 'video'])->name('video');

});

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



Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::post('/update_profile', [DashboardController::class, 'update'])->name('update_profile');
    Route::delete('/hapusakun', [DashboardController::class, 'hapusakun'])->name('hapusakun');

    Route::delete('/delete_account_managemen', [DashboardController::class, 'hapusakunmanagemen'])->name('hapusakunmanagemen');

});
