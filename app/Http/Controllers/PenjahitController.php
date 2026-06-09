<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recycle;

class PenjahitController extends Controller
{
    public function dashboard()
    {
        $recycles = Recycle::where('penjahit_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('penjahit.dashboard', compact('recycles'));
    }

    public function acceptProject($id)
    {
        $recycle = Recycle::findOrFail($id);
        if ($recycle->penjahit_id === Auth::id() && $recycle->status === 'assigned') {
            $recycle->status = 'dikerjakan';
            $recycle->save();
            return redirect()->back()->with('success', 'Project berhasil disetujui, siap dikerjakan.');
        }
        return redirect()->back()->withErrors(['message' => 'Status tidak valid.']);
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:dikerjakan,selesai'
        ]);
        
        $recycle = Recycle::findOrFail($id);
        
        if ($recycle->penjahit_id === Auth::id()) {
            $recycle->status = $request->status;
            $recycle->save();
            return redirect()->back()->with('success', 'Status berhasil diperbarui!');
        }
        
        return redirect()->back()->withErrors(['message' => 'Akses tidak diizinkan.']);
    }
}
