<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Panel\UserController as PanelUserController;
use App\Http\Controllers\Panel\DashboardController as PanelDashboardController;
use App\Http\Controllers\Panel\PendaftaranController;
use App\Http\Controllers\Panel\PermissionController;
use App\Http\Controllers\Panel\Referensi\AsalSekolahController;
use App\Http\Controllers\Panel\Referensi\MateriController;
use App\Http\Controllers\Panel\Referensi\BankSoalController;
use App\Http\Controllers\Panel\RoleController;
use App\Http\Controllers\Panel\TryoutController;
use App\Http\Controllers\Panel\TryoutOpenController;
use App\Http\Controllers\Panel\TryoutJawabanController;
use App\Http\Controllers\Panel\TryoutMateriController;
use App\Http\Controllers\Panel\TryoutSoalController;
use App\Http\Controllers\Siswa\UserController as SiswaUserController;
use App\Http\Controllers\Siswa\DashboardController as SiswaashboardController;
use App\Http\Controllers\Siswa\TryoutController as SiswaaasTryoutController;
use App\Http\Controllers\Siswa\TryoutPesertaController as SiswaaasTryoutPesertaController;
use App\Http\Controllers\Siswa\InvoiceController as SiswaaasInvoiceController;
use App\Http\Controllers\Siswa\PengerjaanController as SiswaasPengerjaanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/daftar_tryout/{tryoutId}', [HomeController::class, 'daftarTryout'])->name('daftar_tryout');
Route::post('/daftar_tryout/{tryoutId}', [HomeController::class, 'daftarTryoutStore'])->name('daftar_tryout.store');
Route::get('/daftar_tryout_success', function(){
    return view('pages.daftar_tryout_success');
})->name('daftar_tryout.success');

// =========================================================================
// == PINDAHKAN GRUP REGISTRASI KE SINI (DI LUAR GRUP SISWA) ==
// =========================================================================
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showChoiceForm')->name('register.choice');
    Route::get('/register/siswa', 'showSiswaForm')->name('register.siswa');
    Route::post('/register/siswa', 'registerSiswa');
    Route::get('/register/pengajar', 'showPengajarForm')->name('register.pengajar');
    Route::post('/register/pengajar', 'registerPengajar');
});
// =========================================================================

Route::get('ajax/materi-tryout', [AjaxController::class, 'materiTryout'])->name('ajax.materi-tryout');
Route::get('ajax/cari-sekolah', [AjaxController::class, 'cariSekolah'])->name('ajax.cari-sekolah');
Route::get('ajax/cari-siwa', [AjaxController::class, 'cariSiswa'])->name('ajax.cari-siswa');
Route::get('ajax/get-jawaban', [AjaxController::class, 'getJawaban'])->name('ajax.get-jawaban');
Route::post('ajax/upload-img-soal', [AjaxController::class, 'uploadImgSoal'])->name('ajax.upload-img-soal');
/* Route Admin & Pengajar */
Route::name('panel.')->prefix('panel')->group(function () {
    Route::get('/', [PanelUserController::class, 'login'])->name('login');
    Route::post('login', [PanelUserController::class, 'doLogin'])->name('doLogin');

    Route::group(['middleware' => ['admin']], function () {
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

        Route::resource('tryout', TryoutController::class);
        Route::resource('tryout_open', TryoutOpenController::class);

        Route::post('tryout/{tryout_id}/addPeserta', [TryoutController::class, 'addPeserta'])->name('tryout.addPeserta');
        Route::delete('tryout/deletePeserta/{tryout_id}', [TryoutController::class, 'deletePeserta'])->name('tryout.deletePeserta');
        Route::post('tryout/{tryout_id}/addMateri', [TryoutController::class, 'addMateri'])->name('tryout.addMateri');
        Route::post('tryout/{tryout_id}/editMateri', [TryoutController::class, 'editMateri'])->name('tryout.editMateri');
        Route::get('tryout/{tryout_id}/exportPeserta', [TryoutController::class, 'exportPeserta'])->name('tryout.exportPeserta');
        Route::resource('tryout_materi', TryoutMateriController::class);
        Route::get('tryout_materi/{tryout_materi}/createJawaban', [TryoutMateriController::class, 'createJawaban'])->name('tryout_materi.createJawaban');
        Route::post('tryout_materi/{tryout_materi}/storeJawaban', [TryoutMateriController::class, 'storeJawaban'])->name('tryout_materi.storeJawaban');
        Route::put('tryout_materi/{tryout_materi}/updateJawaban', [TryoutMateriController::class, 'updateJawaban'])->name('tryout_materi.updateJawaban');
        Route::resource('tryout_jawaban', TryoutSoalController::class);

        Route::resource('referensi/materi', MateriController::class);
        Route::resource('referensi/asal_sekolah', AsalSekolahController::class);
        Route::get('referensi/bank_soal', [BankSoalController::class,'index'])->name('bank_soal.index');
        Route::get('referensi/bank_soal/{id}', [BankSoalController::class,'show'])->name('bank_soal.show');

        Route::resource('role', RoleController::class);
        Route::resource('permission', PermissionController::class);

        Route::get('pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
        Route::get('pendaftaran/{tryout_peserta_id}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');
        Route::post('pendaftaran/{tryout_peserta_id}/approve', [PendaftaranController::class, 'approve'])->name('pendaftaran.approve');

        Route::post('logout', [PanelUserController::class, 'logout'])->name('logout');
    });
});

/* Route Siswa */
Route::get('/siswa', [App\Http\Controllers\SiswaController::class, 'index'])->name('siswa.index');
Route::get('/login', [SiswaUserController::class, 'login'])->name('login');
Route::get('/google/redirect', [SiswaUserController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [SiswaUserController::class, 'handleGoogleCallback'])->name('google.callback');

Route::name('siswa.')->prefix('siswa')->group(function () {
    Route::post('login', [SiswaUserController::class, 'doLogin'])->name('doLogin');
    Route::get('forgot_password', [SiswaUserController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('forgot_password', [SiswaUserController::class, 'doForgotPassword'])->name('doForgotPassword');
    Route::get('reset_password', [SiswaUserController::class, 'passwordReset'])->name('password.reset');
    Route::post('reset_password', [SiswaUserController::class, 'doPasswordReset'])->name('do.password.reset');
    // Route::get('register', [SiswaUserController::class, 'register'])->name('register');
    // Route::post('register', [SiswaUserController::class, 'doRegister'])->name('doRegister');

    // == GRUP INI SUDAH DIPINDAH KELUAR ==

    Route::get('complete-profile/', [SiswaUserController::class, 'profileComplete'])->name('profile.complete');
    Route::put('complete-profile/', [SiswaUserController::class, 'doProfileComplete'])->name('profile.complete.update');

    Route::group(['middleware' => ['auth',  'user.aktif', 'complete.profile','siswa']], function () {
        Route::get('dashboard', [SiswaashboardController::class, 'index'])->name('dashboard');

        Route::get('library', [SiswaaasTryoutController::class, 'library'])->name('tryout.library');

        Route::get('profile', [SiswaUserController::class, 'profile'])->name('profile.index');
        Route::get('profile/edit', [SiswaUserController::class, 'edit'])->name('profile.edit');
        Route::put('profile/', [SiswaUserController::class, 'update'])->name('profile.update');


        Route::resource('tryout', SiswaaasTryoutController::class);
        Route::get('tryout/{tryout}/daftar', [SiswaaasTryoutController::class, 'daftar'])->name('tryout.daftar');
        Route::get('tryout/{tryout}/detail', [SiswaaasTryoutController::class, 'detail'])->name('tryout.detail');
        Route::resource('tryout_peserta', SiswaaasTryoutPesertaController::class);
        Route::resource('invoice', SiswaaasInvoiceController::class);

        Route::get('tryout/{tryout_materi_id}/pengerjaan', [SiswaasPengerjaanController::class, 'create'])->name('tryout.pengerjaan.create');
        Route::post('tryout/{tryout_materi_id}/pengerjaan', [SiswaasPengerjaanController::class, 'store'])->name('tryout.pengerjaan.store');

        Route::post('tryout/{nilai}/jawab', [SiswaasPengerjaanController::class, 'jawab'])->name('tryout.pengerjaan.jawab');
        Route::get('tryout/{nilai}/leave', [SiswaasPengerjaanController::class, 'leave'])->name('tryout.pengerjaan.leave');
        Route::get('tryout/{nilai}/selesai', [SiswaasPengerjaanController::class, 'selesai'])->name('tryout.pengerjaan.selesai');

        Route::get('analisa/{pengerjaan_id}/detail', [SiswaasPengerjaanController::class, 'analisa'])->name('tryout.pengerjaan.analisa');

        Route::post('logout', [SiswaUserController::class, 'logout'])->name('logout');
    });
});