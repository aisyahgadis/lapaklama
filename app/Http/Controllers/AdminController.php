<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recycle;

class AdminController extends Controller
{
    // Halaman Manajemen User
    public function users()
    {
        $users = User::where('jenis', '!=', 'admin')
                    ->orderBy('created_at', 'desc')
                    ->get();
        $totalUsers = $users->count();

        return view('admin.user', compact('users', 'totalUsers'));
    }

    // Halaman Persetujuan Penjual Baru
    public function persetujuan()
    {
        $daftarPenjual = User::where('jenis', 'penjual')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('admin.persetujuan', compact('daftarPenjual'));
    }

    // Hapus user
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.user')->with('success', 'User berhasil dihapus.');
    }

    // Halaman Kelola Penjahit (Recycle Detail)
    public function recycleDetail()
    {
        $recycles = Recycle::where('status', 'menunggu_assign')->get();
        $penjahits = User::where('jenis', 'penjahit')->get();
        
        return view('admin.recycle-detail', compact('recycles', 'penjahits'));
    }
}
