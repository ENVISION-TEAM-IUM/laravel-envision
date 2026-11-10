<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinasiController;
use App\Http\Controllers\Admin\PaketWisataController;
use App\Http\Controllers\Admin\UmkmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes - Desa Wisata Karangkemiri
|--------------------------------------------------------------------------
| Mendukung URL standar Laravel maupun URL dengan ekstensi .html
| agar kompatibel 100% dengan link statis dan JavaScript interaktif.
*/

// ==========================================
// 1. HALAMAN PUBLIK WEBSITE
// ==========================================

// 01. Beranda
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/index.html', function () {
    return redirect('/');
});

Route::get('/index', function () {
    return redirect('/');
});

// 02. Profil Desa Wisata
Route::get('/profil', function () {
    return view('profil');
})->name('profil');

Route::get('/profil.html', function () {
    return view('profil');
})->name('profil.html');

// 03. Destinasi Wisata
Route::get('/destinasi', function () {
    return view('destinasi');
})->name('destinasi');

Route::get('/destinasi.html', function () {
    return view('destinasi');
})->name('destinasi.html');

// 04. Detail Destinasi (Interaktif per slug: candi, embung, kelengkeng, petilasan)
Route::get('/detail-destinasi', function () {
    return view('detail-destinasi');
})->name('detail-destinasi');

Route::get('/detail-destinasi.html', function () {
    return view('detail-destinasi');
})->name('detail-destinasi.html');

// 05. Paket Wisata
Route::get('/paket-wisata', function () {
    return view('paket-wisata');
})->name('paket-wisata');

Route::get('/paket-wisata.html', function () {
    return view('paket-wisata');
})->name('paket-wisata.html');

// 06. Katalog UMKM
Route::get('/katalog-umkm', function () {
    return view('katalog-umkm');
})->name('katalog-umkm');

Route::get('/katalog-umkm.html', function () {
    return view('katalog-umkm');
})->name('katalog-umkm.html');

// 07. Kontak & Lokasi
Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('/kontak.html', function () {
    return view('kontak');
})->name('kontak.html');


// ==========================================
// 2. PANEL CMS ADMIN
// ==========================================

// Redirect /admin ke dashboard
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth:admin');

// 01. Login Admin
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->middleware('auth:admin');

Route::get('/admin-login', function () {
    return redirect()->route('admin.login');
});

Route::get('/admin-login.html', function () {
    return redirect()->route('admin.login');
})->name('admin.login.html');
// Semua halaman CMS hanya dapat diakses admin yang sudah login
Route::middleware('auth:admin')->group(function () {

    // 02. Dashboard Admin
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin-dashboard', fn () => redirect()->route('admin.dashboard'));
    Route::get('/admin-dashboard.html', fn () => redirect()->route('admin.dashboard'))->name('admin.dashboard.html');

    // 03. Edit Beranda
    Route::get('/admin/beranda', fn () => view('admin.beranda'))->name('admin.beranda');
    Route::get('/admin-beranda', fn () => redirect()->route('admin.beranda'));
    Route::get('/admin-beranda.html', fn () => view('admin.beranda'))->name('admin.beranda.html');

    // 04. Edit Profil Desa
    Route::get('/admin/profil', fn () => view('admin.profil'))->name('admin.profil');
    Route::get('/admin-profil', fn () => redirect()->route('admin.profil'));
    Route::get('/admin-profil.html', fn () => view('admin.profil'))->name('admin.profil.html');

    // 05. Kelola Destinasi (CRUD)
    Route::get('/admin/destinasi', [DestinasiController::class, 'index'])->name('admin.destinasi.index');
    Route::get('/admin/destinasi/create', [DestinasiController::class, 'create'])->name('admin.destinasi.create');
    Route::post('/admin/destinasi', [DestinasiController::class, 'store'])->name('admin.destinasi.store');
    Route::get('/admin/destinasi/{destinasi}/edit', [DestinasiController::class, 'edit'])->name('admin.destinasi.edit');
    Route::put('/admin/destinasi/{destinasi}', [DestinasiController::class, 'update'])->name('admin.destinasi.update');
    Route::delete('/admin/destinasi/{destinasi}', [DestinasiController::class, 'destroy'])->name('admin.destinasi.destroy');

    // Kompatibilitas URL statis destinasi
    Route::get('/admin-destinasi', fn () => redirect()->route('admin.destinasi.index'));
    Route::get('/admin-destinasi.html', fn () => redirect()->route('admin.destinasi.index'))->name('admin.destinasi.html');
    Route::get('/admin/edit-destinasi', function (Request $request) {
        if ($request->query('slug') === 'new' || !$request->filled('slug')) {
            return redirect()->route('admin.destinasi.create');
        }
        return redirect()->route('admin.destinasi.edit', $request->query('slug'));
    })->name('admin.edit-destinasi');
    Route::get('/admin-edit-destinasi', fn (Request $request) => redirect()->route('admin.edit-destinasi', $request->query()));
    Route::get('/admin-edit-destinasi.html', fn (Request $request) => redirect()->route('admin.edit-destinasi', $request->query()))->name('admin.edit-destinasi.html');

    // 06. Kelola Paket Wisata (CRUD)
    Route::get('/admin/paket', [PaketWisataController::class, 'index'])->name('admin.paket.index');
    Route::post('/admin/paket', [PaketWisataController::class, 'store'])->name('admin.paket.store');
    Route::put('/admin/paket/{paket}', [PaketWisataController::class, 'update'])->name('admin.paket.update');
    Route::delete('/admin/paket/{paket}', [PaketWisataController::class, 'destroy'])->name('admin.paket.destroy');

    Route::get('/admin-paket', fn () => redirect()->route('admin.paket.index'));
    Route::get('/admin-paket.html', fn () => redirect()->route('admin.paket.index'))->name('admin.paket.html');

    // 07. Kelola Katalog UMKM & Produk (CRUD)
    Route::get('/admin/umkm', [UmkmController::class, 'index'])->name('admin.umkm.index');
    Route::post('/admin/umkm', [UmkmController::class, 'storeUmkm'])->name('admin.umkm.store');
    Route::put('/admin/umkm/{umkm}', [UmkmController::class, 'updateUmkm'])->name('admin.umkm.update');
    Route::delete('/admin/umkm/{umkm}', [UmkmController::class, 'destroyUmkm'])->name('admin.umkm.destroy');

    Route::post('/admin/umkm/produk', [UmkmController::class, 'storeProduk'])->name('admin.umkm.produk.store');
    Route::put('/admin/umkm/produk/{produk}', [UmkmController::class, 'updateProduk'])->name('admin.umkm.produk.update');
    Route::delete('/admin/umkm/produk/{produk}', [UmkmController::class, 'destroyProduk'])->name('admin.umkm.produk.destroy');

    Route::get('/admin-umkm', fn () => redirect()->route('admin.umkm.index'));
    Route::get('/admin-umkm.html', fn () => redirect()->route('admin.umkm.index'))->name('admin.umkm.html');

    // 08. Edit Kontak & Lokasi
    Route::get('/admin/kontak', fn () => view('admin.kontak'))->name('admin.kontak');
    Route::get('/admin-kontak', fn () => redirect()->route('admin.kontak'));
    Route::get('/admin-kontak.html', fn () => view('admin.kontak'))->name('admin.kontak.html');
// 10. Pratinjau & Publikasi
Route::get('/admin/pratinjau', function () {
    return view('admin.pratinjau');
})->name('admin.pratinjau');

Route::get('/admin-pratinjau', function () {
    return view('admin.pratinjau');
});

Route::get('/admin-pratinjau.html', function () {
    return view('admin.pratinjau');
})->name('admin.pratinjau.html');
    
});
