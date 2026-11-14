<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\GaleriFoto;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DestinasiController extends Controller
{
    /**
     * Display a listing of public destinations.
     */
    public function index(Request $request): View
    {
        $destinasiList = Destinasi::query()
            ->where('status', 'Tayang')
            ->orderBy('id', 'asc')
            ->get();

        return view('destinasi', compact('destinasiList'));
    }

    /**
     * Display the specified destination detail.
     */
    public function show(Request $request, ?string $slug = null): View
    {
        $targetSlug = $slug ?? $request->query('slug');

        $destinasi = null;
        if (! empty($targetSlug)) {
            $destinasi = Destinasi::query()
                ->where('slug', $targetSlug)
                ->orWhere('id', $targetSlug)
                ->first();
        }

        if (! $destinasi) {
            $destinasi = Destinasi::query()
                ->where('status', 'Tayang')
                ->orderBy('id', 'asc')
                ->first();
        }

        if (! $destinasi) {
            $destinasi = new Destinasi([
                'slug' => 'candi',
                'nama' => 'Wahana Edukasi & Outbound Candi',
                'kategori' => 'Edukasi & Outbound',
                'lokasi' => 'Desa Karangkemiri, Kec. Karanglewas, Kab. Banyumas',
                'jam_buka' => 'Senin–Ahad, 08.00–17.00 WIB',
                'harga_tiket' => 'Mulai Rp 75.000 – Rp 100.000',
                'deskripsi' => 'Destinasi utama untuk kegiatan sekolah, instansi, dan keluarga dengan wahana permainan outbound, latihan ketangkasan, flying fox, panahan, serta edukasi kelompok di area terbuka yang asri.',
                'foto' => 'assets/images/candi.png',
                'status' => 'Tayang',
            ]);
        }

        $destinasiList = Destinasi::query()
            ->where('status', 'Tayang')
            ->orderBy('id', 'asc')
            ->get();

        $galeriList = GaleriFoto::query()
            ->where('status', 'Tayang')
            ->orderBy('urutan', 'asc')
            ->take(3)
            ->get();

        return view('detail-destinasi', compact('destinasi', 'destinasiList', 'galeriList'));
    }
}
