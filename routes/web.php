<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Panel\UserController as PanelUserController;
use App\Http\Controllers\Panel\ForgotPasswordController;
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
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\TryoutController as SiswaTryoutController;
use App\Http\Controllers\Siswa\TryoutPesertaController as SiswaTryoutPesertaController;
use App\Http\Controllers\Siswa\InvoiceController as SiswaInvoiceController;
use App\Http\Controllers\Siswa\PengerjaanController as SiswaPengerjaanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Panel\InvoiceController;
use App\Http\Controllers\Panel\KelasCendekiaController;
use App\Http\Controllers\Siswa\KelasCendekiaController as SiswaKelasCendekiaController;
use App\Http\Controllers\Siswa\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/daftar_tryout/{tryoutId}', [HomeController::class, 'daftarTryout'])->name('daftar_tryout');
Route::post('/daftar_tryout/{tryoutId}', [HomeController::class, 'daftarTryoutStore'])->name('daftar_tryout.store');
Route::get('/daftar_tryout_success', function () {
    return view('pages.daftar_tryout_success');
})->name('daftar_tryout.success');

// ===========================
// Registrasi (Public)
// ===========================
// Redirect legacy /register to the student registration form
Route::permanentRedirect('/register', '/register/siswa');
Route::controller(RegisterController::class)->group(function () {
    // /register choice form is disabled in favour of direct student registration
    // Route::get('/register', 'showChoiceForm')->name('register.choice');
    Route::get('/register/siswa', 'showSiswaForm')->name('register.siswa');
    Route::post('/register/siswa', 'registerSiswa');
    Route::get('/register/pengajar', 'showPengajarForm')->name('register.pengajar');
    Route::post('/register/pengajar', 'registerPengajar');
    
    // Email verification endpoints (send OTP & verify OTP)
    Route::post('/verify-email', 'verifyEmailRealtime')->name('verify.email.realtime');
    Route::post('/verify-otp', 'verifyOTP')->name('verify.otp');
});

// ===========================
// AJAX
// ===========================
Route::get('ajax/materi-tryout', [AjaxController::class, 'materiTryout'])->name('ajax.materi-tryout');
Route::get('ajax/materi-kelas', [AjaxController::class, 'materiKelas'])->name('ajax.materi-kelas');
Route::get('ajax/cari-sekolah', [AjaxController::class, 'cariSekolah'])->name('ajax.cari-sekolah');
Route::get('ajax/cari-siwa', [AjaxController::class, 'cariSiswa'])->name('ajax.cari-siswa');
Route::get('ajax/cari-guru', [AjaxController::class, 'cariGuru'])->name('ajax.cari-guru');
Route::get('ajax/get-jawaban', [AjaxController::class, 'getJawaban'])->name('ajax.get-jawaban');
Route::get('ajax/cari-kelas-cendekia', [AjaxController::class, 'getKelaCendekia'])->name('ajax.get-kelas-cendekia');
Route::post('ajax/upload-img-soal', [AjaxController::class, 'uploadImgSoal'])->name('ajax.upload-img-soal');

// ===========================
// PANEL ADMIN / PENGAJAR
// ===========================
Route::name('panel.')->prefix('panel')->group(function () {
    Route::get('/', [PanelUserController::class, 'login'])->name('login');
    Route::post('login', [PanelUserController::class, 'doLogin'])->name('doLogin');

    // Panel forgot-password (OTP + reset) - panel-specific flow
    Route::get('forgot_password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('forgot_password', [ForgotPasswordController::class, 'doForgotPassword'])->name('doForgotPassword');
    Route::get('enter-otp', [ForgotPasswordController::class, 'enterOtp'])->name('enterOtp');
    Route::post('verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('verifyOtp');
    Route::get('reset_password', [ForgotPasswordController::class, 'passwordReset'])->name('password.reset');
    Route::post('reset_password', [ForgotPasswordController::class, 'doPasswordReset'])->name('do.password.reset');

    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', [PanelDashboardController::class, 'index'])->name('dashboard');

        Route::get('pages-profile', function () {
            $user = Auth::user();
            return view('pages.panel.pages-profile', compact('user'));
        })->name('pages.profile');

        // =======================
        // USER MANAGEMENT
        // =======================
        Route::name('user.')->prefix('user')->group(function () {
            Route::get('/', [PanelUserController::class, 'index'])->name('index'); // list user
            Route::get('/create', [PanelUserController::class, 'create'])->name('create'); // form tambah
            Route::post('/', [PanelUserController::class, 'store'])->name('store'); // simpan user baru
            Route::get('/download-template', [PanelUserController::class, 'downloadTemplate'])->name('download-template'); // download template excel
            Route::post('/import-excel', [PanelUserController::class, 'importExcel'])->name('import-excel'); // import siswa dari excel
            Route::get('{user}/edit', [PanelUserController::class, 'edit'])->name('edit'); // edit
            Route::put('{user}', [PanelUserController::class, 'update'])->name('update'); // update
            Route::get('{user}', [PanelUserController::class, 'show'])->name('show'); // detail
            Route::delete('{user}', [PanelUserController::class, 'destroy'])->name('destroy'); // hapus
        });

        // =======================
        // TRYOUT MANAGEMENT
        // =======================
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

        // =======================
        // KELAS CENDEKIA MANGEMENT
        // ======================= 
        Route::name('kelas_cendekia.')->group(function () {
            Route::get('kelas_cendekia', [KelasCendekiaController::class, 'index'])->name('index');
            Route::get('kelas_cendekia/{id}', [KelasCendekiaController::class, 'show'])->name('show');
            Route::post('kelas_cendekia', [KelasCendekiaController::class, 'store'])->name('store');
            Route::put('kelas_cendekia/{id}', [KelasCendekiaController::class, 'update'])->name('update');

            Route::delete('kelas_cendekia/{id}', [KelasCendekiaController::class, 'destroy'])->name('destroy');

            Route::post('kelas_cendekia/addMateri', [KelasCendekiaController::class, 'addMateri'])->name('addMateri');
            Route::put('kelas_cendekia/updateMateri/{id}', [KelasCendekiaController::class, 'updateMateri'])->name('updateMateri');
            Route::delete('kelas_cendekia/destroyMateri/{id}', [KelasCendekiaController::class, 'destroyMateri'])->name('destroyMateri');

            Route::get('kelas_cendekia/{id}/edit', [KelasCendekiaController::class, 'edit'])->name('edit');

            Route::get('kelas_cendekia/{id}/add_siswa', [KelasCendekiaController::class, 'addSiswa'])->name('addSiswa');
            Route::post('kelas_cendekia/{id}/store_siswa', [KelasCendekiaController::class, 'storeSiswa'])->name('storeSiswa');
            Route::delete('kelas_cendekia/destroySiswa/{kelas_cendekia_id}/{kelas_siswa_cendekia}', [KelasCendekiaController::class, 'destroySiswa'])->name('destroySiswa');
        });


        // =======================
        // REFERENSI
        // =======================
        Route::resource('referensi/materi', MateriController::class);
        Route::resource('referensi/asal_sekolah', AsalSekolahController::class);
        Route::post('referensi/asal_sekolah/import', [AsalSekolahController::class, 'import'])->name('asal_sekolah.import');
        Route::get('referensi/bank_soal', [BankSoalController::class, 'index'])->name('bank_soal.index');
        Route::get('referensi/bank_soal/{id}', [BankSoalController::class, 'show'])->name('bank_soal.show');

        Route::resource('role', RoleController::class);
        Route::resource('permission', PermissionController::class);
        Route::resource('invoices', InvoiceController::class);

        // =======================
        // PENDAFTARAN TRYOUT
        // =======================
        Route::get('pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
        Route::get('pendaftaran/export', [PendaftaranController::class, 'export'])->name('pendaftaran.export');
        Route::get('pendaftaran/{tryout_peserta_id}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');
        Route::post('pendaftaran/{tryout_peserta_id}/approve', [PendaftaranController::class, 'approve'])->name('pendaftaran.approve');
        Route::post('pendaftaran/{tryout_peserta_id}/reject', [PendaftaranController::class, 'reject'])->name('pendaftaran.reject');

        // =======================
        // LOGOUT
        // =======================
        Route::post('logout', [PanelUserController::class, 'logout'])->name('logout');
    });
});

// ===========================
// SISWA
// ===========================
// Redirect /siswa ke dashboard jika sudah login, ke login jika belum
Route::get('/siswa', function() {
    if (Auth::check()) {
        return redirect()->route('siswa.dashboard');
    }
    return redirect()->route('login');
})->name('siswa.index');

Route::get('/login', [SiswaUserController::class, 'login'])->name('login');
Route::get('/google/redirect', [SiswaUserController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [SiswaUserController::class, 'handleGoogleCallback'])->name('google.callback');
Route::post('/webhook/midtrans/notify', [PaymentController::class, 'handleNotification']);


Route::name('siswa.')->prefix('siswa')->group(function () {
    // Route for public student registration (handled by Siswa\UserController@doRegister)
    Route::post('register', [SiswaUserController::class, 'doRegister'])->name('doRegister');
    Route::post('login', [SiswaUserController::class, 'doLogin'])->name('doLogin');
    Route::get('forgot_password', [SiswaUserController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('forgot_password', [SiswaUserController::class, 'doForgotPassword'])->name('doForgotPassword');
    Route::get('enter-otp', [SiswaUserController::class, 'enterOtp'])->name('enterOtp');
    Route::post('verify-otp', [SiswaUserController::class, 'verifyOtp'])->name('verifyOtp');
    Route::get('reset_password', [SiswaUserController::class, 'passwordReset'])->name('password.reset');
    Route::post('reset_password', [SiswaUserController::class, 'doPasswordReset'])->name('do.password.reset');

    Route::get('complete-profile/', [SiswaUserController::class, 'profileComplete'])->name('profile.complete');
    Route::put('complete-profile/', [SiswaUserController::class, 'doProfileComplete'])->name('profile.complete.update');

    Route::group(['middleware' => ['auth', 'user.aktif', 'complete.profile', 'siswa']], function () {
        Route::get('dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
        Route::get('library', [SiswaTryoutController::class, 'library'])->name('tryout.library');

        Route::get('profile', [SiswaUserController::class, 'profile'])->name('profile.index');
        Route::get('profile/edit', [SiswaUserController::class, 'edit'])->name('profile.edit');
        Route::put('profile/', [SiswaUserController::class, 'update'])->name('profile.update');

        Route::resource('tryout', SiswaTryoutController::class);
        Route::get('tryout/{tryout}/daftar', [SiswaTryoutController::class, 'daftar'])->name('tryout.daftar');
        Route::get('tryout/{tryout}/detail', [SiswaTryoutController::class, 'detail'])->name('tryout.detail');
        Route::resource('tryout_peserta', SiswaTryoutPesertaController::class);
        Route::resource('invoice', SiswaInvoiceController::class);

        Route::get('siswa/detail/{id}', [SiswaController::class, 'detail'])->name('siswa.detail');
        Route::get('tryout/{tryout_materi_id}/pengerjaan/{tryout_peserta_id}', [SiswaPengerjaanController::class, 'create'])->name('tryout.pengerjaan.create');
        Route::post('tryout/{tryout_materi_id}/pengerjaan', [SiswaPengerjaanController::class, 'store'])->name('tryout.pengerjaan.store');
        Route::post('tryout/{nilai}/jawab', [SiswaPengerjaanController::class, 'jawab'])->name('tryout.pengerjaan.jawab');
        Route::get('tryout/{nilai}/leave/{tryout_peserta_id}', [SiswaPengerjaanController::class, 'leave'])->name('tryout.pengerjaan.leave');
        Route::get('tryout/{nilai}/selesai/{tryout_peserta_id}', [SiswaPengerjaanController::class, 'selesai'])->name('tryout.pengerjaan.selesai');
        Route::get('analisa/{pengerjaan_id}/detail', [SiswaPengerjaanController::class, 'analisa'])->name('tryout.pengerjaan.analisa');

        Route::name('kelas_cendekia.')->group(function () {
            Route::get('kelas_cendekia', [SiswaKelasCendekiaController::class, 'index'])->name('index');
            Route::get('kelas_cendekia/{kelas_cendekia_id}', [SiswaKelasCendekiaController::class, 'show'])->name('show');
        });

        Route::post('/payment', [PaymentController::class, 'createSnapToken'])->name('payment.snapToken');

        Route::post('logout', [SiswaUserController::class, 'logout'])->name('logout');
    });
});
