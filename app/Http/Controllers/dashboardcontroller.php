<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// PASTIKAN NAMA MODEL DI BAWAH INI SESUAI DENGAN PROJECT KAMU
use App\Models\Shop;       // Model untuk Toko/Penjual
use App\Models\Production; // Model untuk Antrean Produksi
use App\Models\Tailor;     // Model untuk Penjahit
use App\Models\Product;    // Model untuk Produk

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Mengambil data untuk Statistik (Cards)
        $penjualMenunggu = Shop::where('status', 'pending')->count();
        $menungguPenjahit = Production::where('status', 'pending')->count(); // Sesuaikan statusnya
        $penjahitAktif = Tailor::where('status', 'aktif')->count();
        $totalProduk = Product::count();

        // 2. Mengambil data untuk List Tabel (Dibatasi 5 data terbaru agar rapi)
        $permintaanToko = Shop::where('status', 'pending')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        $antreanProduksi = Production::where('status', 'pending')
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