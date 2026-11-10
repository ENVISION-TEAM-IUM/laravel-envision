<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\PaketWisata;
use App\Models\ProdukUmkm;
use App\Models\Umkm;
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

        return view('admin.dashboard', compact(
            'totalDestinasi',
            'totalPaket',
            'totalUmkm',
            'totalProduk'
        ));
    }
}
