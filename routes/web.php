<?php

use App\Http\Controllers\Admin\AdminLoginController;
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
    return redirect('/admin-dashboard.html');
});

// 01. Login Admin
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::get('/admin-login', function () {
    return view('admin.login');
});

Route::get('/admin-login.html', function () {
    return view('admin.login');
})->name('admin.login.html');

// 02. Dashboard Admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin-dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin-dashboard.html', function () {
    return view('admin.dashboard');
})->name('admin.dashboard.html');

// 03. Edit Beranda
Route::get('/admin/beranda', function () {
    return view('admin.beranda');
})->name('admin.beranda');

Route::get('/admin-beranda', function () {
    return view('admin.beranda');
});

Route::get('/admin-beranda.html', function () {
    return view('admin.beranda');
})->name('admin.beranda.html');

// 04. Edit Profil Desa
Route::get('/admin/profil', function () {
    return view('admin.profil');
})->name('admin.profil');

Route::get('/admin-profil', function () {
    return view('admin.profil');
});

Route::get('/admin-profil.html', function () {
    return view('admin.profil');
})->name('admin.profil.html');

// 05. Kelola Destinasi
Route::get('/admin/destinasi', function () {
    return view('admin.destinasi');
})->name('admin.destinasi');

Route::get('/admin-destinasi', function () {
    return view('admin.destinasi');
});

Route::get('/admin-destinasi.html', function () {
    return view('admin.destinasi');
})->name('admin.destinasi.html');

// 06. Edit Detail Destinasi
Route::get('/admin/edit-destinasi', function () {
    return view('admin.edit-destinasi');
})->name('admin.edit-destinasi');

Route::get('/admin-edit-destinasi', function () {
    return view('admin.edit-destinasi');
});

Route::get('/admin-edit-destinasi.html', function () {
    return view('admin.edit-destinasi');
})->name('admin.edit-destinasi.html');

// 07. Kelola Paket Wisata
Route::get('/admin/paket', function () {
    return view('admin.paket');
})->name('admin.paket');

Route::get('/admin-paket', function () {
    return view('admin.paket');
});

Route::get('/admin-paket.html', function () {
    return view('admin.paket');
})->name('admin.paket.html');

// 08. Kelola Katalog UMKM
Route::get('/admin/umkm', function () {
    return view('admin.umkm');
})->name('admin.umkm');

Route::get('/admin-umkm', function () {
    return view('admin.umkm');
});

Route::get('/admin-umkm.html', function () {
    return view('admin.umkm');
})->name('admin.umkm.html');

// 09. Edit Kontak & Lokasi
Route::get('/admin/kontak', function () {
    return view('admin.kontak');
})->name('admin.kontak');

Route::get('/admin-kontak', function () {
    return view('admin.kontak');
});

Route::get('/admin-kontak.html', function () {
    return view('admin.kontak');
})->name('admin.kontak.html');

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
