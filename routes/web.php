<?php

use Illuminate\Support\Facades\Route;

// Halaman Beranda
Route::get('/', function () {
    return view('home');
});

// Halaman Profil Desa
Route::get('/profil.html', function () {
    return view('profil');
});
