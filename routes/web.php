<?php

use Illuminate\Support\Facades\Route;

// Halaman Beranda
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/index.html', function () {
    return redirect('/');
});

// Halaman Profil Desa
Route::get('/profil.html', function () {
    return view('profil');
})->name('profil');

Route::get('/profil', function () {
    return view('profil');
})->name('profil.clean');
