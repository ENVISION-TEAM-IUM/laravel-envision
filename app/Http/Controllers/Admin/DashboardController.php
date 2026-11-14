<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\PaketWisata;
use App\Models\ProdukUmkm;
use App\Models\Umkm;
use App\Models\FeedbackLayanan;
use App\Models\KunjunganDigital;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the CMS Admin Dashboard with current database statistics.
     */
    public function index(): View
    {
        $totalDestinasi = Destinasi::count();
        $totalPaket = PaketWisata::where('status', 'Aktif')->count();
        $totalUmkm = Umkm::count();
        $totalProduk = ProdukUmkm::count();

        $totalKunjungan = KunjunganDigital::where('tipe', 'kunjungan')->count();
        $totalKlikWa = KunjunganDigital::where('tipe', 'klik_wa')->count();
        $kunjunganHariIni = KunjunganDigital::where('tipe', 'kunjungan')
            ->whereDate('created_at', today())
            ->count();
        $totalFeedback = FeedbackLayanan::count();
        $recentFeedbacks = FeedbackLayanan::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalDestinasi',
            'totalPaket',
            'totalUmkm',
            'totalProduk',
            'totalKunjungan',
            'totalKlikWa',
            'kunjunganHariIni',
            'totalFeedback',
            'recentFeedbacks'
        ));
    }
}
