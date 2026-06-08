<?php

namespace App\Http\Controllers;

use App\Models\Recycle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecycleController extends Controller
{
    // Menyimpan request daur ulang baru
    public function store(Request $request)
    {
        $request->validate([
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'description' => 'required|string|min:10',
            'category'    => 'nullable|string',
        ], [
            'image.required'       => 'Foto pakaian wajib diupload.',
            'image.image'          => 'File harus berupa gambar.',
            'description.required' => 'Deskripsi wajib diisi.',
            'description.min'      => 'Deskripsi minimal 10 karakter.',
        ]);

        // Pastikan user terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Simpan gambar
        $path = $request->file('image')->store('recycles', 'public');

        // Simpan recycle dengan user_id jelas
        $recycle = Recycle::create([
            'user_id'   => $user->id, // Jangan pake Auth::id(), pake $user->id secara eksplisit
            'gambar'    => $path,
            'deskripsi' => $request->description,
            'kategori'  => $request->category,
            'status'    => 'menunggu_assign',
        ]);

        // Debug: log user info
        \Log::info('Recycle Submitted', [
            'user_id' => $user->id,
            'nama' => $user->nama,
            'jenis' => $user->jenis,
            'status_penjual' => $user->status_penjual ?? 'n/a',
            'isApprovedPenjual' => $user->isApprovedPenjual(),
        ]);

        // Redirect ke halaman sukses sesuai jenis user
        // Gunakan method dari User model untuk cek apakah penjual yang approved
        if ($user->isApprovedPenjual()) {
            return redirect()->route('penjual.succes')->with('success', 'Ide daur ulang berhasil dikirim!');
        } else {
            // Semua user lain ke user-succes (user pembeli, penjahit, admin, penjual pending)
            return redirect()->route('user.user-succes')->with('success', 'Ide daur ulang berhasil dikirim!');
        }
    }

    // Halaman tracking daur ulang
    public function tracking()
    {
        $recycle = Recycle::where('user_id', Auth::id())
                         ->orderBy('created_at', 'desc')
                         ->first();

        return view('penjual.tracking', compact('recycle'));
    }

    // Tracking untuk user (pembeli)
    public function userTracking()
    {
        $recycle = Recycle::where('user_id', Auth::id())
                         ->orderBy('created_at', 'desc')
                         ->first();

        return view('user.user-tracking', compact('recycle'));
    }

    // Update Alamat dan Resi
    public function updateResi(Request $request, $id)
    {
        $request->validate([
            'alamat_pengiriman' => 'nullable|string',
            'kode_resi' => 'nullable|string',
        ]);

        $recycle = Recycle::where('user_id', Auth::id())->findOrFail($id);
        
        if ($request->filled('alamat_pengiriman')) {
            $recycle->alamat_pengiriman = $request->alamat_pengiriman;
        }
        
        if ($request->filled('kode_resi')) {
            $recycle->kode_resi = $request->kode_resi;
        }

        $recycle->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }
}
