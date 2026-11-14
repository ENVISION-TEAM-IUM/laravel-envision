<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BerandaSetting;
use App\Models\Destinasi;
use App\Models\KontakDesa;
use App\Models\ProfilDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PratinjauController extends Controller
{
    /**
     * Display the CMS page for Pratinjau & Publikasi.
     */
    public function index(): View
    {
        $beranda = BerandaSetting::current();
        $profil = ProfilDesa::current();
        $kontak = KontakDesa::current();
        $destinations = Destinasi::query()->orderBy('nama')->get();

        return view('admin.pratinjau', compact('beranda', 'profil', 'kontak', 'destinations'));
    }

    /**
     * Publish all staged changes to the public website.
     */
    public function publish(Request $request): RedirectResponse
    {
        $beranda = BerandaSetting::current();
        $beranda->status = 'Tayang';
        $beranda->save();

        $profil = ProfilDesa::current();
        $profil->status = 'Tayang';
        $profil->save();

        return redirect()->route('admin.pratinjau')->with('success', 'Selamat! Seluruh perubahan berhasil diterbitkan ke Website Publik Desa Wisata Karangkemiri.');
    }

    /**
     * Save all staged changes as draft.
     */
    public function draft(Request $request): RedirectResponse
    {
        $beranda = BerandaSetting::current();
        $beranda->status = 'Draf';
        $beranda->save();

        $profil = ProfilDesa::current();
        $profil->status = 'Draf';
        $profil->save();

        return redirect()->route('admin.pratinjau')->with('success', 'Perubahan berhasil disimpan sebagai Draf dan belum ditampilkan ke pengunjung.');
    }
}
