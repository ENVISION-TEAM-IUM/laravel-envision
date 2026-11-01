<?php

use App\Http\Controllers\Admin\AdminLoginController;
use Illuminate\Support\Facades\Route;

// Halaman Beranda Website Desa
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/index.html', function () {
    return redirect('/');
});

Route::get('/admin-login.html', function () {
    return redirect()->route('admin.login');
});

Route::get('/admin', function () {
    return redirect()->route('admin.login');
});

// Halaman Profil Desa
Route::get('/profil.html', function () {
    return view('profil');
})->name('profil');

Route::get('/profil', function () {
    return view('profil');
})->name('profil.clean');

/*
|--------------------------------------------------------------------------
| CMS Admin BUMDes Routes
|--------------------------------------------------------------------------
|
| Rute untuk area pengelolaan CMS Admin BUMDes.
| Menggunakan guard 'admin' yang terpisah dari akun pengguna reguler.
|
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Rute Guest: Hanya bisa diakses oleh admin yang belum login
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AdminLoginController::class, 'login'])->name('login.submit');
    });

    // Rute Terproteksi: Memerlukan autentikasi guard 'admin'
    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

        Route::get('dashboard', [AdminLoginController::class, 'dashboard'])->name('dashboard');

        // Modul-modul CMS Admin dapat ditambahkan di dalam grup ini:
        // Route::resource('destinasi', DestinasiController::class);
        // Route::resource('umkm', UmkmController::class);
    });
});
