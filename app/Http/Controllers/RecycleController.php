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

        // Simpan gambar
        $path = $request->file('image')->store('recycles', 'public');

        Recycle::create([
            'user_id'   => Auth::id(),
            'gambar'    => $path,
            'deskripsi' => $request->description,
            'status'    => 'menunggu_assign',
        ]);

        return redirect()->route('penjual.succes')->with('success', 'Ide daur ulang berhasil dikirim!');
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
}
