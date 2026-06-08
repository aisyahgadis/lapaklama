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

    // Approve Penjual
    public function approveSeller($id)
    {
        $user = User::findOrFail($id);
        if ($user->jenis === 'penjual' && $user->status_penjual === 'pending') {
            $user->status_penjual = 'approved';
            $user->save();
            return redirect()->back()->with('success', 'Penjual berhasil disetujui.');
        }
        return redirect()->back()->withErrors(['message' => 'Status penjual tidak valid.']);
    }

    // Halaman Persetujuan Penjual Baru
    public function persetujuan()
    {
        $daftarPenjual = User::where('jenis', 'penjual')
                            ->where('status_penjual', 'pending')
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
        $recycles = Recycle::orderBy('created_at', 'desc')->get();
        $penjahits = User::where('jenis', 'penjahit')->get();
        
        return view('admin.recycle-detail', compact('recycles', 'penjahits'));
    }

    // Assign Penjahit ke Recycle Request
    public function assignPenjahit(Request $request, $id)
    {
        $request->validate([
            'penjahit_id' => 'required|exists:users,id'
        ]);

        $recycle = Recycle::findOrFail($id);
        $recycle->penjahit_id = $request->penjahit_id;
        $recycle->status = 'assigned';
        $recycle->save();

        return redirect()->back()->with('success', 'Penjahit berhasil ditugaskan!');
    }
    
    public function updateRecycleStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:assigned,dikerjakan,selesai'
        ]);

        $recycle = Recycle::findOrFail($id);
        $recycle->status = $request->status;
        $recycle->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }
}
