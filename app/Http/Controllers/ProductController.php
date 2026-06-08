<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // ... fungsi index() dan store() yang sudah kamu miliki biarkan saja di sini ...

    // 1. Menampilkan halaman katalog beserta filter
    public function katalog(Request $request)
    {
        // Mulai dengan mengambil produk yang statusnya 'tersedia'
        $query = Product::where('status', 'tersedia');

        // LOGIKA FILTER 1: Pencarian Nama/Deskripsi
        if ($request->filled('search')) {
            $query->where('deskripsi', 'like', '%' . $request->search . '%');
        }

        // LOGIKA FILTER 2: Kategori
        if ($request->filled('kategori') && $request->kategori != 'all') {
            $query->where('kategori', $request->kategori);
        }

        // LOGIKA FILTER 3: Range Harga
        if ($request->filled('min_price')) {
            $query->where('harga', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('harga', '<=', $request->max_price);
        }

        // Eksekusi query dan ambil datanya
        $products = $query->orderBy('created_at', 'desc')->get();
        
        // Kirim data produk dan request ke view
        return view('user.buy-user', compact('products', 'request')); 
    }

    // 2. Menampilkan halaman Detail Produk
    public function detail($id)
    {
        $product = Product::findOrFail($id);
        
        // Jika user iseng mengakses URL produk yang sudah terjual
        if($product->status == 'terjual') {
            return redirect()->route('user.buy-user')->withErrors(['message' => 'Yah, barang sudah terjual!']);
        }

        return view('user.detail-product', compact('product'));
    }

    // 3. Menampilkan halaman Checkout
    public function checkout($id)
    {
        $product = Product::findOrFail($id);
        
        // Pastikan barang masih tersedia sebelum masuk checkout
        if($product->status == 'terjual') {
            return redirect()->route('user.buy-user')->withErrors(['message' => 'Maaf, barang ini baru saja terjual.']);
        }

        return view('user.checkout', compact('product'));
    }

    // 4. Memproses Pembayaran (Menggantikan fungsi beliProduk lama)
    public function prosesPembayaran($id)
    {
        $product = Product::findOrFail($id);

        // Cek apakah produk masih tersedia
        if ($product->status !== 'tersedia') {
            return redirect()->route('user.buy-user')->withErrors(['message' => 'Maaf, transaksi gagal karena produk sudah terjual.']);
        }

        // Update status produk menjadi 'terjual' di database
        $product->status = 'terjual';
        $product->save();

        // (Opsional) Simpan informasi pembeli, history transaksi, dll di sini nanti

        // Kembali ke halaman katalog dengan pesan sukses
        return redirect()->route('user.buy-user')->with('success', 'Pembayaran berhasil! Barang segera dikirim.');
    }
}