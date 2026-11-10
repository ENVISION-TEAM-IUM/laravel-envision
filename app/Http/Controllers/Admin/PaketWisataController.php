<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\PaketWisata;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PaketWisataController extends Controller
{
    /**
     * Display a listing of the tour packages and the active management form.
     */
    public function index(Request $request): View
    {
        $packages = PaketWisata::query()->latest()->get();
        $destinations = Destinasi::query()->orderBy('nama')->get();

        $selectedPackage = null;
        if ($request->filled('edit')) {
            $selectedPackage = PaketWisata::where('slug', $request->query('edit'))
                ->orWhere('id', $request->query('edit'))
                ->first();
        }

        return view('admin.paket', compact('packages', 'destinations', 'selectedPackage'));
    }

    /**
     * Store a newly created tour package in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_paket' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:Aktif,Nonaktif'],
            'destinasi_terkait' => ['nullable', 'string', 'max:255'],
            'aktivitas_umkm' => ['nullable', 'string', 'max:255'],
            'nomor_wa' => ['nullable', 'string', 'max:50'],
            'fasilitas' => ['nullable', 'string'],
            'deskripsi' => ['nullable', 'string'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif,avif', 'max:10240'],
        ]);

        $baseSlug = Str::slug($validated['nama_paket']);
        $slug = $baseSlug;
        $counter = 1;
        while (PaketWisata::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('paket', 'public');
            $validated['foto'] = 'storage/'.$path;
        } else {
            unset($validated['foto']);
        }

        PaketWisata::create($validated);

        return redirect()->route('admin.paket.index')->with('success', 'Paket wisata baru berhasil ditambahkan!');
    }

    /**
     * Update the specified tour package in storage.
     */
    public function update(Request $request, string $slugOrId): RedirectResponse
    {
        $package = PaketWisata::where('slug', $slugOrId)
            ->orWhere('id', $slugOrId)
            ->firstOrFail();

        $validated = $request->validate([
            'nama_paket' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:Aktif,Nonaktif'],
            'destinasi_terkait' => ['nullable', 'string', 'max:255'],
            'aktivitas_umkm' => ['nullable', 'string', 'max:255'],
            'nomor_wa' => ['nullable', 'string', 'max:50'],
            'fasilitas' => ['nullable', 'string'],
            'deskripsi' => ['nullable', 'string'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif,avif', 'max:10240'],
        ]);

        if ($request->hasFile('foto')) {
            if ($package->foto && str_starts_with($package->foto, 'storage/')) {
                $oldPath = str_replace('storage/', '', $package->foto);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('foto')->store('paket', 'public');
            $validated['foto'] = 'storage/'.$path;
        } else {
            unset($validated['foto']);
        }

        $package->update($validated);

        return redirect()->route('admin.paket.index')->with('success', 'Data paket wisata berhasil diperbarui!');
    }

    /**
     * Remove the specified tour package from storage.
     */
    public function destroy(string $slugOrId): RedirectResponse
    {
        $package = PaketWisata::where('slug', $slugOrId)
            ->orWhere('id', $slugOrId)
            ->firstOrFail();

        if ($package->foto && str_starts_with($package->foto, 'storage/')) {
            $oldPath = str_replace('storage/', '', $package->foto);
            Storage::disk('public')->delete($oldPath);
        }

        $package->delete();

        return redirect()->route('admin.paket.index')->with('success', 'Paket wisata berhasil dihapus!');
    }
}
