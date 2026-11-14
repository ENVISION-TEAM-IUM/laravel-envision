<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfilController extends Controller
{
    /**
     * Display the CMS page for editing Profil Desa.
     */
    public function index(): View
    {
        $profil = ProfilDesa::current();

        return view('admin.profil', compact('profil'));
    }

    /**
     * Update the Profil Desa settings in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'hero_caption' => ['required', 'string', 'max:255'],
            'summary' => ['required', 'string'],
            'status' => ['required', 'string', 'in:Tayang,Draf'],
            'history' => ['required', 'string'],
            'potensi_desc' => ['required', 'string'],
            'culture_desc' => ['required', 'string'],
            'access_info' => ['nullable', 'string'],
            'since_year' => ['required', 'string', 'max:20'],
            'manager' => ['required', 'string', 'max:255'],
            'focus' => ['required', 'string', 'max:255'],
            'vision_title' => ['required', 'string', 'max:255'],
            'vision' => ['required', 'string'],
            'goal' => ['required', 'string'],
            'mission' => ['required', 'string'],
            'main_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'structure_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'support_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ]);

        $profil = ProfilDesa::current();

        if ($request->hasFile('main_photo')) {
            $path = $request->file('main_photo')->store('profil', 'public');
            $validated['main_photo'] = 'storage/'.$path;
        } else {
            unset($validated['main_photo']);
        }

        if ($request->hasFile('structure_photo')) {
            $path = $request->file('structure_photo')->store('profil', 'public');
            $validated['structure_photo'] = 'storage/'.$path;
        } else {
            unset($validated['structure_photo']);
        }

        if ($request->hasFile('support_photo')) {
            $path = $request->file('support_photo')->store('profil', 'public');
            $validated['support_photo'] = 'storage/'.$path;
        } else {
            unset($validated['support_photo']);
        }

        $profil->fill($validated);
        $profil->save();

        return redirect()->route('admin.profil')->with('success', 'Informasi Profil Desa berhasil diperbarui dan disinkronkan ke halaman publik!');
    }

    /**
     * Reset Profil Desa to default values.
     */
    public function reset(): RedirectResponse
    {
        $profil = ProfilDesa::current();
        $profil->fill(ProfilDesa::defaultAttributes());
        $profil->save();

        return redirect()->route('admin.profil')->with('success', 'Formulir profil desa telah dikembalikan ke data awal bawaan.');
    }
}
