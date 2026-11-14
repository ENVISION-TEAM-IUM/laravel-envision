<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaketWisataController extends Controller
{
    /**
     * Display a listing of public tour packages.
     */
    public function index(Request $request): View
    {
        $paketList = PaketWisata::query()
            ->where('status', 'Aktif')
            ->latest()
            ->get();

        return view('paket-wisata', compact('paketList'));
    }
}
