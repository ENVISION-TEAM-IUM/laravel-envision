<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DestinasiController extends Controller
{
    /**
     * Display a listing of the destination resources.
     */
    public function index(Request $request): View
    {
        $query = Destinasi::query()->latest();

        if ($request->filled('search')) {
            $search = (string) $request->input('search');
            $query->where(function ($q) use ($search): void {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        $destinasi = $query->get();

        return view('admin.destinasi', compact('destinasi'));
    }

    /**
     * Show the form for creating a new destination.
     */
    public function create(): View
    {
        return view('admin.edit-destinasi', ['destinasi' => null]);
    }

    /**
     * Store a newly created destination in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'jam_buka' => ['nullable', 'string', 'max:255'],
            'harga_tiket' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'status' => ['required', 'string', 'in:Tayang,Draf,Sembunyikan'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif,avif', 'max:10240'],
        ]);

        $baseSlug = Str::slug($validated['nama']);
        $slug = $baseSlug;
        $counter = 1;
        while (Destinasi::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('destinasi', 'public');
            $validated['foto'] = 'storage/'.$path;
        } else {
            unset($validated['foto']);
        }

        Destinasi::create($validated);

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi wisata berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified destination.
     */
    public function edit(string $slugOrId): View
    {
        $destinasi = Destinasi::where('slug', $slugOrId)
            ->orWhere('id', $slugOrId)
            ->firstOrFail();

        return view('admin.edit-destinasi', compact('destinasi'));
    }

    /**
     * Update the specified destination in storage.
     */
    public function update(Request $request, string $slugOrId): RedirectResponse
    {
        $destinasi = Destinasi::where('slug', $slugOrId)
            ->orWhere('id', $slugOrId)
            ->firstOrFail();

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'jam_buka' => ['nullable', 'string', 'max:255'],
            'harga_tiket' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'status' => ['required', 'string', 'in:Tayang,Draf,Sembunyikan'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif,avif', 'max:10240'],
        ]);

        if ($request->hasFile('foto')) {
            // Hapus file lama jika disimpan di storage lokal
            if ($destinasi->foto && str_starts_with($destinasi->foto, 'storage/')) {
                $oldPath = str_replace('storage/', '', $destinasi->foto);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('foto')->store('destinasi', 'public');
            $validated['foto'] = 'storage/'.$path;
        } else {
            unset($validated['foto']);
        }

        $destinasi->update($validated);

        return redirect()->route('admin.destinasi.index')->with('success', 'Data destinasi wisata berhasil diperbarui!');
    }

    /**
     * Remove the specified destination from storage.
     */
    public function destroy(string $slugOrId): RedirectResponse
    {
        $destinasi = Destinasi::where('slug', $slugOrId)
            ->orWhere('id', $slugOrId)
            ->firstOrFail();

        if ($destinasi->foto && str_starts_with($destinasi->foto, 'storage/')) {
            $oldPath = str_replace('storage/', '', $destinasi->foto);
            Storage::disk('public')->delete($oldPath);
        }

        $destinasi->delete();

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi wisata berhasil dihapus!');
    }
}
