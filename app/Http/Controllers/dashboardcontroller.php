<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Recycle;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Mengambil data untuk Statistik (Cards)
        $penjualMenunggu = User::where('jenis', 'penjual')->count();
        $menungguPenjahit = Recycle::where('status', 'menunggu_assign')->count();
        $penjahitAktif = User::where('jenis', 'penjahit')->count();
        $totalProduk = Product::count();

        // 2. Mengambil data untuk List Tabel (Dibatasi 5 data terbaru agar rapi)
        $permintaanToko = User::where('jenis', 'penjual')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        $antreanProduksi = Recycle::where('status', 'menunggu_assign')
                            ->with('user')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        // 3. Mengirim variabel ke file blade
        return view('admin.dashboard', compact(
            'penjualMenunggu',
            'menungguPenjahit',
            'penjahitAktif',
            'totalProduk',
            'permintaanToko',
            'antreanProduksi'
        ));
    }
}