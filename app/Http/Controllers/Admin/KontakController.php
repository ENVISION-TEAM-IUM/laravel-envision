<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontakDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KontakController extends Controller
{
    /**
     * Display the CMS page for editing Kontak & Lokasi.
     */
    public function index(): View
    {
        $kontak = KontakDesa::current();

        return view('admin.kontak', compact('kontak'));
    }

    /**
     * Update Kontak & Lokasi settings in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'address' => ['required', 'string'],
            'whatsapp' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'hours' => ['required', 'string', 'max:255'],
            'maps_url' => ['required', 'url'],
            'maps_embed' => ['nullable', 'string'],
            'instagram' => ['nullable', 'url'],
            'facebook' => ['nullable', 'url'],
            'tiktok' => ['nullable', 'url'],
            'youtube' => ['nullable', 'url'],
        ]);

        $kontak = KontakDesa::current();
        $kontak->fill($validated);
        $kontak->save();

        return redirect()->route('admin.kontak')->with('success', 'Informasi Kontak & Lokasi Desa Wisata Karangkemiri berhasil diperbarui!');
    }

    /**
     * Reset Kontak & Lokasi to default values.
     */
    public function reset(): RedirectResponse
    {
        $kontak = KontakDesa::current();
        $kontak->fill(KontakDesa::defaultAttributes());
        $kontak->save();

        return redirect()->route('admin.kontak')->with('success', 'Informasi kontak dan tautan lokasi telah dikembalikan ke pengaturan awal Karangkemiri.');
    }
}
