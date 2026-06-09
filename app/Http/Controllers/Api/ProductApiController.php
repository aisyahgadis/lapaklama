<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductApiController extends Controller
{
    // =========================================================
    // ADMIN FUNCTIONS
    // =========================================================
    public function adminIndex()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        $totalProduk = Product::count();
        
        return response()->json([
            'success' => true,
            'products' => $products,
            'total' => $totalProduk
        ]);
    }

    // =========================================================
    // PENJUAL FUNCTIONS
    // =========================================================
    // Daftar produk milik penjual
    public function sellerIndex()
    {
        $products = Product::where('user_id', Auth::id())
                          ->orderBy('created_at', 'desc')
                          ->get();
        
        return response()->json([
            'success' => true,
            'products' => $products
        ]);
    }

    // Simpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'gambar'    => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'harga'     => 'required|numeric|min:0',
            'deskripsi' => 'required|string|min:10',
            'kategori'  => 'required|string',
        ], [
            'nama.required'       => 'Nama produk wajib diisi.',
            'gambar.required'    => 'Foto produk wajib diupload.',
            'gambar.image'       => 'File harus berupa gambar.',
            'gambar.max'         => 'Ukuran gambar maksimal 5MB.',
            'harga.required'     => 'Harga wajib diisi.',
            'harga.numeric'      => 'Harga harus berupa angka.',
            'deskripsi.required' => 'Deskripsi produk wajib diisi.',
            'deskripsi.min'      => 'Deskripsi minimal 10 karakter.',
            'kategori.required'  => 'Kategori wajib dipilih.',
        ]);

        // Simpan gambar
        $path = $request->file('gambar')->store('products', 'public');

        $product = Product::create([
            'user_id'   => Auth::id(),
            'nama'      => $request->nama,
            'gambar'    => $path,
            'harga'     => $request->harga,
            'kategori'  => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'status'    => 'tersedia',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan!',
            'product' => $product
        ], 201);
    }

    // Detail produk untuk edit
    public function show($id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }

    // Update produk
    public function update(Request $request, $id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'nama'      => 'required|string|max:255',
            'harga'     => 'required|numeric|min:0',
            'deskripsi' => 'required|string|min:10',
            'kategori'  => 'required|string',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $product->nama = $request->nama;
        $product->harga = $request->harga;
        $product->deskripsi = $request->deskripsi;
        $product->kategori = $request->kategori;

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('products', 'public');
            $product->gambar = $path;
        }

        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diperbarui!',
            'product' => $product
        ]);
    }

    // Hapus produk
    public function destroy($id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus!'
        ]);
    }

    // =========================================================
    // USER (PEMBELI) FUNCTIONS
    // =========================================================
    // Katalog produk dengan filter
    public function katalog(Request $request)
    {
        $query = Product::where('status', 'tersedia');

        // Filter pencarian
        if ($request->filled('search')) {
            $query->where('deskripsi', 'like', '%' . $request->search . '%');
        }

        // Filter kategori
        if ($request->filled('kategori') && $request->kategori != 'all') {
            $query->where('kategori', $request->kategori);
        }

        // Filter harga
        if ($request->filled('min_price')) {
            $query->where('harga', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('harga', '<=', $request->max_price);
        }

        $products = $query->orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'success' => true,
            'products' => $products
        ]);
    }

    // Detail produk untuk pembeli
    public function detail($id)
    {
        $product = Product::findOrFail($id);
        
        if($product->status == 'terjual') {
            return response()->json([
                'success' => false,
                'message' => 'Yah, barang sudah terjual!'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }

    // Checkout (simpan ke session)
    public function processCheckout(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->status !== 'tersedia') {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, produk sudah tidak tersedia.'
            ], 400);
        }

        $request->validate([
            'nama_penerima' => 'required|string',
            'no_telp' => 'required|string',
            'alamat' => 'required|string',
            'metode_pembayaran' => 'required|string',
        ]);

        // Simpan ke session
        $request->session()->put('checkout_data_' . $id, $request->only(['nama_penerima', 'no_telp', 'alamat', 'metode_pembayaran']));

        return response()->json([
            'success' => true,
            'message' => 'Checkout berhasil!',
            'redirect_to' => route('user.payment', $id)
        ]);
    }

    // Proses pembayaran
    public function prosesPembayaran(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->status !== 'tersedia') {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, transaksi gagal karena produk sudah terjual.'
            ], 400);
        }

        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $checkoutData = $request->session()->get('checkout_data_' . $id);

        if (!$checkoutData) {
            return response()->json([
                'success' => false,
                'message' => 'Sesi checkout berakhir. Silakan isi kembali data pengiriman.'
            ], 400);
        }

        // Simpan bukti bayar
        $path = $request->file('bukti_bayar')->store('payments', 'public');

        // Buat order
        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'alamat' => $checkoutData['alamat'],
            'status' => 'menunggu',
            'nama_penerima' => $checkoutData['nama_penerima'],
            'no_telp' => $checkoutData['no_telp'],
            'metode_pembayaran' => $checkoutData['metode_pembayaran'],
            'bukti_bayar' => $path,
        ]);

        // Hapus session
        $request->session()->forget('checkout_data_' . $id);

        // Update status produk
        $product->status = 'terjual';
        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil! Menunggu konfirmasi penjual.',
            'redirect_to' => route('user.orders')
        ]);
    }
}
