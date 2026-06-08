<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Halaman admin: daftar semua produk
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        $totalProduk = Product::count();
        return view('admin.product', compact('products', 'totalProduk'));
    }

    // Menyimpan produk baru dari form jual baju
    public function store(Request $request)
    {
        $request->validate([
            'gambar'    => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'harga'     => 'required|numeric|min:0',
            'deskripsi' => 'required|string|min:10',
            'kategori'  => 'nullable|string',
        ], [
            'gambar.required'    => 'Foto produk wajib diupload.',
            'gambar.image'       => 'File harus berupa gambar.',
            'gambar.max'         => 'Ukuran gambar maksimal 5MB.',
            'harga.required'     => 'Harga wajib diisi.',
            'harga.numeric'      => 'Harga harus berupa angka.',
            'deskripsi.required' => 'Deskripsi produk wajib diisi.',
            'deskripsi.min'      => 'Deskripsi minimal 10 karakter.',
        ]);

        // Simpan gambar ke storage/app/public/products
        $path = $request->file('gambar')->store('products', 'public');

        Product::create([
            'user_id'   => Auth::id(),
            'gambar'    => $path,
            'harga'     => $request->harga,
            'kategori'  => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'status'    => 'tersedia',
        ]);

        return redirect()->route('penjual.success-jual')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Halaman penjual: daftar produk milik penjual yang login
    public function sellerProducts()
    {
        $products = Product::where('user_id', Auth::id())
                          ->orderBy('created_at', 'desc')
                          ->get();
        return view('penjual.product', compact('products'));
    }

    // Halaman edit produk penjual
    public function edit($id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);
        return view('penjual.edit-product', compact('product'));
    }

    // Proses update produk
    public function update(Request $request, $id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'harga'     => 'required|numeric|min:0',
            'deskripsi' => 'required|string|min:10',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $product->harga = $request->harga;
        $product->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('products', 'public');
            $product->gambar = $path;
        }

        $product->save();

        return redirect()->route('penjual.product')->with('success', 'Produk berhasil diperbarui!');
    }

    // Hapus produk
    public function destroy($id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);
        $product->delete();

        return redirect()->route('penjual.product')->with('success', 'Produk berhasil dihapus!');
    }

    // =========================================================
    // USER (PEMBELI) FUNCTIONS
    // =========================================================

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
        
        // Kirim data produk ke view
        return view('user.buy-user', compact('products'));
    }

    // 2. Menampilkan halaman Detail Produk
    public function detail($id)
    {
        $product = Product::findOrFail($id);
        
        // Jika user iseng mengakses URL produk yang sudah terjual
        if($product->status == 'terjual') {
            return redirect()->route('user.buy-user')->withErrors(['message' => 'Yah, barang sudah terjual!']);
        }

        return view('user.view-product', compact('product'));
    }

    // 3. Menampilkan halaman Checkout
    public function checkout($id)
    {
        $product = Product::findOrFail($id);
        
        // Pastikan barang masih tersedia sebelum masuk checkout
        if($product->status == 'terjual') {
            return redirect()->route('user.buy-user')->withErrors(['message' => 'Maaf, barang ini baru saja terjual.']);
        }

        return view('user.chekout', compact('product'));
    }

    // 4. Menampilkan halaman Payment
    public function payment($id)
    {
        $product = Product::findOrFail($id);

        if ($product->status !== 'tersedia') {
            return redirect()->route('user.buy-user')->withErrors(['message' => 'Maaf, produk sudah tidak tersedia.']);
        }

        return view('user.payment', compact('product'));
    }

    // 5. Memproses Pembayaran
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

        // Kembali ke halaman katalog dengan pesan sukses
        return redirect()->route('user.buy-user')->with('success', 'Pembayaran berhasil! Barang segera dikirim.');
    }
}