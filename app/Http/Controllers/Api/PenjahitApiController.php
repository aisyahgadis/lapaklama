<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PenjahitApiController extends Controller
{
    public function __construct()
    {
        // Middleware akan ditangani di routes/api.php
    }

    /**
     * Get all penjahit
     */
    public function index()
    {
        $penjahits = User::where('jenis', 'penjahit')
            ->orderBy('created_at', 'desc')
            ->get(['id', 'nama', 'email', 'no_hp', 'created_at']);

        return response()->json([
            'success' => true,
            'data' => $penjahits
        ]);
    }

    /**
     * Store a newly created penjahit in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'no_hp' => 'required|string|max:20',
        ]);

        $penjahit = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jenis' => 'penjahit',
            'no_hp' => $request->no_hp,
            'status_penjual' => 'tidak_ada',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Penjahit berhasil ditambahkan!',
            'data' => $penjahit
        ], 201);
    }

    /**
     * Display the specified penjahit
     */
    public function show($id)
    {
        $penjahit = User::where('jenis', 'penjahit')->find($id);

        if (!$penjahit) {
            return response()->json([
                'success' => false,
                'message' => 'Penjahit tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $penjahit
        ]);
    }

    /**
     * Update the specified penjahit in storage
     */
    public function update(Request $request, $id)
    {
        $penjahit = User::where('jenis', 'penjahit')->find($id);

        if (!$penjahit) {
            return response()->json([
                'success' => false,
                'message' => 'Penjahit tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'nama' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'no_hp' => 'sometimes|string|max:20',
        ]);

        $penjahit->update($request->only(['nama', 'email', 'no_hp']));

        return response()->json([
            'success' => true,
            'message' => 'Penjahit berhasil diperbarui!',
            'data' => $penjahit
        ]);
    }

    /**
     * Remove the specified penjahit from storage
     */
    public function destroy($id)
    {
        $penjahit = User::where('jenis', 'penjahit')->find($id);

        if (!$penjahit) {
            return response()->json([
                'success' => false,
                'message' => 'Penjahit tidak ditemukan'
            ], 404);
        }

        $penjahit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Penjahit berhasil dihapus!'
        ]);
    }
}
