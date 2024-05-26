<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Panel\UserController as PanelUserController;
use App\Http\Controllers\Panel\DashboardController as PanelDashboardController;
use App\Http\Controllers\Panel\PermissionController;
use App\Http\Controllers\Panel\Referensi\MateriController;
use App\Http\Controllers\Panel\RoleController;
use App\Http\Controllers\Panel\TryoutController;
use App\Http\Controllers\Siswa\UserController as SiswaUserController;
use App\Http\Controllers\Siswa\DashboardController as SiswaashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('ajax/materi-tryout',[AjaxController::class,'materiTryout'])->name('ajax.materi-tryout');
Route::get('ajax/cari-sekolah',[AjaxController::class,'cariSekolah'])->name('ajax.cari-sekolah');
/* Route Admin & Pengajar */
Route::name('panel.')->prefix('panel')->group(function () {
    Route::get('/', [PanelUserController::class, 'login'])->name('login');
    Route::post('login', [PanelUserController::class, 'doLogin'])->name('doLogin');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('dashboard', [PanelDashboardController::class, 'index'])->name('dashboard');

        Route::name('user.')->prefix('user')->group(function () {
            Route::get('/', [PanelUserController::class, 'index'])->name('index');
            Route::get('/create', [PanelUserController::class, 'store'])->name('store');
            Route::post('/', [PanelUserController::class, 'store'])->name('store');
            Route::get('{user}', [PanelUserController::class, 'show'])->name('show');
            Route::get('{user}/edit', [PanelUserController::class, 'edit'])->name('edit');
            Route::put('{user}', [PanelUserController::class, 'update'])->name('update');
            Route::delete('{user}', [PanelUserController::class, 'destroy'])->name('destroy');
        });

        Route::resource('tryout',TryoutController::class);

        Route::resource('referensi/materi',MateriController::class);

        Route::resource('role', RoleController::class);
        Route::resource('permission', PermissionController::class);

        Route::post('logout', [PanelUserController::class, 'logout'])->name('logout');
    });
});

/* Route Siswa */
Route::get('/login', [SiswaUserController::class, 'login'])->name('login');
Route::name('siswa.')->prefix('siswa')->group(function () {

    Route::post('login', [SiswaUserController::class, 'doLogin'])->name('doLogin');

    Route::get('register', [SiswaUserController::class, 'register'])->name('register');
    Route::post('register', [SiswaUserController::class, 'doRegister'])->name('doRegister');


    Route::group(['middleware' => ['auth']], function () {
        Route::get('dashboard', [SiswaashboardController::class, 'index'])->name('dashboard');

        Route::post('logout', [SiswaUserController::class, 'logout'])->name('logout');
    });
});
