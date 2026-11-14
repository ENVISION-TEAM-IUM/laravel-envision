<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BerandaSetting;
use App\Models\Destinasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BerandaController extends Controller
{
    /**
     * Display the CMS page for editing Beranda.
     */
    public function index(): View
    {
        $beranda = BerandaSetting::current();
        $destinations = Destinasi::query()->orderBy('nama')->get();

        return view('admin.beranda', compact('beranda', 'destinations'));
    }

    /**
     * Update the Beranda settings in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_subtitle' => ['required', 'string'],
            'button_text' => ['required', 'string', 'max:255'],
            'featured_destinations' => ['nullable', 'array'],
            'featured_destinations.*' => ['string'],
            'status' => ['nullable', 'string', 'in:Tayang,Draf'],
        ]);

        $beranda = BerandaSetting::current();
        $beranda->hero_title = $validated['hero_title'];
        $beranda->hero_subtitle = $validated['hero_subtitle'];
        $beranda->button_text = $validated['button_text'];
        $beranda->featured_destinations = $validated['featured_destinations'] ?? [];
        if (isset($validated['status'])) {
            $beranda->status = $validated['status'];
        }
        $beranda->save();

        return redirect()->route('admin.beranda')->with('success', 'Perubahan halaman Beranda berhasil disimpan!');
    }
}
