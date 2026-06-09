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
        // Data untuk stat cards
        $penjualMenunggu = User::where('jenis', 'penjual')->where('status_penjual', 'pending')->count();
        $menungguPenjahit = Recycle::where('status', 'menunggu_assign')->count();
        $penjahitAktif = User::where('jenis', 'penjahit')->count();
        $totalProduk = Product::count();
        
        // Data untuk list permintaan toko
        $permintaanToko = User::where('jenis', 'penjual')->where('status_penjual', 'pending')->orderBy('created_at', 'desc')->take(5)->get();
        
        // Data untuk antrean produksi
        $antreanProduksi = Recycle::where('status', 'menunggu_assign')->orderBy('created_at', 'desc')->take(5)->get();
        
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
