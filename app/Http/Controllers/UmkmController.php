<?php

namespace App\Http\Controllers;

use App\Models\ProdukUmkm;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UmkmController extends Controller
{
    /**
     * Display a listing of public UMKM and their active products.
     */
    public function index(Request $request): View
    {
        $umkmList = Umkm::query()
            ->with(['produk' => function ($query): void {
                $query->where('status', 'Tayang');
            }])
            ->where('status', 'Tayang')
            ->orderBy('nama_usaha', 'asc')
            ->get();

        $produkList = ProdukUmkm::query()
            ->with('umkm')
            ->where('status', 'Tayang')
            ->whereHas('umkm', function ($query): void {
                $query->where('status', 'Tayang');
            })
            ->latest()
            ->get();

        return view('katalog-umkm', compact('umkmList', 'produkList'));
    }
}
