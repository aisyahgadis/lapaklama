<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recycle;
use App\Models\User;

class PersetujuanController extends Controller
{
    // Proses pilih penjahit untuk project daur ulang
    public function pilihPenjahit(Request $request)
    {
        $request->validate([
            'project_id'  => 'required|exists:recycles,id',
            'penjahit_id' => 'required|exists:users,id',
        ]);

        $recycle = Recycle::findOrFail($request->project_id);
        $recycle->penjahit_id = $request->penjahit_id;
        $recycle->status = 'assigned';
        $recycle->save();

        return redirect()->back()->with('success', 'Penjahit berhasil dipilih untuk project ini!');
    }
}
