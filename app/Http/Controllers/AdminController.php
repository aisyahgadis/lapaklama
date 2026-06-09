<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recycle;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Tampilkan form tambah penjahit
    public function createPenjahit()
    {
        return view('admin.create-penjahit');
    }

    // Simpan penjahit baru
    public function storePenjahit(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'no_hp' => 'required|string|max:20',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jenis' => 'penjahit',
            'no_hp' => $request->no_hp,
            'status_penjual' => 'tidak_ada',
        ]);

        return redirect()->route('admin.recycle-detail')->with('success', 'Penjahit berhasil ditambahkan!');
    }
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
        try {
            $request->validate([
                'status' => 'required|in:assigned,dikerjakan,selesai'
            ]);

            $recycle = Recycle::findOrFail($id);
            $recycle->status = $request->status;
            $recycle->save();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui!']);
            }

            return redirect()->back()->with('success', 'Status berhasil diperbarui!');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
