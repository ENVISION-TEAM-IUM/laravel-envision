<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProdukUmkm;
use App\Models\Umkm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UmkmController extends Controller
{
    /**
     * Display a listing of UMKM businesses and products.
     */
    public function index(Request $request): View
    {
        $umkmList = Umkm::query()->with('produk')->latest()->get();

        $prodQuery = ProdukUmkm::query()->with('umkm')->latest();
        if ($request->filled('filter_umkm') && $request->input('filter_umkm') !== 'all') {
            $prodQuery->where('umkm_id', $request->input('filter_umkm'));
        }
        $products = $prodQuery->get();

        $selectedProduct = null;
        if ($request->filled('edit_product')) {
            $selectedProduct = ProdukUmkm::where('slug', $request->query('edit_product'))
                ->orWhere('id', $request->query('edit_product'))
                ->first();
        }

        $selectedUmkm = null;
        if ($request->filled('edit_umkm')) {
            $selectedUmkm = Umkm::where('slug', $request->query('edit_umkm'))
                ->orWhere('id', $request->query('edit_umkm'))
                ->first();
        }

        $activeTab = (string) $request->query('tab', 'products');

        return view('admin.umkm', compact(
            'umkmList',
            'products',
            'selectedProduct',
            'selectedUmkm',
            'activeTab'
        ));
    }

    /**
     * Store a newly created UMKM profile.
     */
    public function storeUmkm(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_usaha' => ['required', 'string', 'max:255'],
            'nama_pemilik' => ['required', 'string', 'max:255'],
            'sektor_usaha' => ['required', 'string', 'max:255'],
            'nomor_wa' => ['required', 'string', 'max:50'],
            'jam_operasional' => ['nullable', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
            'deskripsi' => ['nullable', 'string'],
            'status' => ['required', 'string', 'in:Tayang,Nonaktif,Draf'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif,avif', 'max:10240'],
        ]);

        $baseSlug = Str::slug($validated['nama_usaha']);
        $slug = $baseSlug;
        $counter = 1;
        while (Umkm::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('umkm', 'public');
            $validated['foto'] = 'storage/'.$path;
        } else {
            unset($validated['foto']);
        }

        Umkm::create($validated);

        return redirect()->route('admin.umkm.index', ['tab' => 'profiles'])
            ->with('success', 'Profil UMKM baru berhasil ditambahkan!');
    }

    /**
     * Update the specified UMKM profile.
     */
    public function updateUmkm(Request $request, string $slugOrId): RedirectResponse
    {
        $umkm = Umkm::where('slug', $slugOrId)
            ->orWhere('id', $slugOrId)
            ->firstOrFail();

        $validated = $request->validate([
            'nama_usaha' => ['required', 'string', 'max:255'],
            'nama_pemilik' => ['required', 'string', 'max:255'],
            'sektor_usaha' => ['required', 'string', 'max:255'],
            'nomor_wa' => ['required', 'string', 'max:50'],
            'jam_operasional' => ['nullable', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
            'deskripsi' => ['nullable', 'string'],
            'status' => ['required', 'string', 'in:Tayang,Nonaktif,Draf'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif,avif', 'max:10240'],
        ]);

        if ($request->hasFile('foto')) {
            if ($umkm->foto && str_starts_with($umkm->foto, 'storage/')) {
                $oldPath = str_replace('storage/', '', $umkm->foto);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('foto')->store('umkm', 'public');
            $validated['foto'] = 'storage/'.$path;
        } else {
            unset($validated['foto']);
        }

        $umkm->update($validated);

        return redirect()->route('admin.umkm.index', ['tab' => 'profiles'])
            ->with('success', 'Profil UMKM berhasil diperbarui!');
    }

    /**
     * Remove the specified UMKM profile.
     */
    public function destroyUmkm(string $slugOrId): RedirectResponse
    {
        $umkm = Umkm::where('slug', $slugOrId)
            ->orWhere('id', $slugOrId)
            ->firstOrFail();

        if ($umkm->foto && str_starts_with($umkm->foto, 'storage/')) {
            $oldPath = str_replace('storage/', '', $umkm->foto);
            Storage::disk('public')->delete($oldPath);
        }

        $umkm->delete();

        return redirect()->route('admin.umkm.index', ['tab' => 'profiles'])
            ->with('success', 'Profil UMKM dan produk terkait berhasil dihapus!');
    }

    /**
     * Store a newly created product for a UMKM.
     */
    public function storeProduk(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'umkm_id' => ['required', 'exists:umkm,id'],
            'nama_produk' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:Tayang,Nonaktif,Draf'],
            'deskripsi' => ['nullable', 'string'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif,avif', 'max:10240'],
        ]);

        $baseSlug = Str::slug($validated['nama_produk']);
        $slug = $baseSlug;
        $counter = 1;
        while (ProdukUmkm::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('produk_umkm', 'public');
            $validated['foto'] = 'storage/'.$path;
        } else {
            unset($validated['foto']);
        }

        ProdukUmkm::create($validated);

        return redirect()->route('admin.umkm.index', ['tab' => 'products'])
            ->with('success', 'Produk UMKM berhasil ditambahkan ke katalog!');
    }

    /**
     * Update the specified product.
     */
    public function updateProduk(Request $request, string $slugOrId): RedirectResponse
    {
        $product = ProdukUmkm::where('slug', $slugOrId)
            ->orWhere('id', $slugOrId)
            ->firstOrFail();

        $validated = $request->validate([
            'umkm_id' => ['required', 'exists:umkm,id'],
            'nama_produk' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:Tayang,Nonaktif,Draf'],
            'deskripsi' => ['nullable', 'string'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif,avif', 'max:10240'],
        ]);

        if ($request->hasFile('foto')) {
            if ($product->foto && str_starts_with($product->foto, 'storage/')) {
                $oldPath = str_replace('storage/', '', $product->foto);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('foto')->store('produk_umkm', 'public');
            $validated['foto'] = 'storage/'.$path;
        } else {
            unset($validated['foto']);
        }

        $product->update($validated);

        return redirect()->route('admin.umkm.index', ['tab' => 'products'])
            ->with('success', 'Data produk UMKM berhasil diperbarui!');
    }

    /**
     * Remove the specified product.
     */
    public function destroyProduk(string $slugOrId): RedirectResponse
    {
        $product = ProdukUmkm::where('slug', $slugOrId)
            ->orWhere('id', $slugOrId)
            ->firstOrFail();

        if ($product->foto && str_starts_with($product->foto, 'storage/')) {
            $oldPath = str_replace('storage/', '', $product->foto);
            Storage::disk('public')->delete($oldPath);
        }

        $product->delete();

        return redirect()->route('admin.umkm.index', ['tab' => 'products'])
            ->with('success', 'Produk berhasil dihapus dari katalog!');
    }
}
