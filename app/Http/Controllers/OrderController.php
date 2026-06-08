<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Recycle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // =========================================================
    // PENJUAL FLOW
    // =========================================================

    public function sellerOrders()
    {
        // Get all orders where the product belongs to the current logged in user (seller)
        $userId = Auth::id();
        $orders = Order::whereHas('product', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->orderBy('created_at', 'desc')->get();
        $recycles = Recycle::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        return view('penjual.pesanan', compact('orders', 'recycles'));
    }

    public function acceptOrder($id)
    {
        $order = Order::findOrFail($id);
        
        // Ensure the current user is the seller of the product
        if ($order->product->user_id !== Auth::id()) {
            return redirect()->back()->withErrors(['message' => 'Unauthorized action.']);
        }

        if ($order->status !== 'menunggu') {
            return redirect()->back()->withErrors(['message' => 'Status tidak valid untuk diterima.']);
        }

        $order->status = 'diproses';
        $order->save();

        return redirect()->route('penjual.orders')->with('success', 'Pesanan berhasil diterima dan sedang diproses.');
    }

    public function shipOrder(Request $request, $id)
    {
        $request->validate([
            'resi' => 'required|string|max:255'
        ]);

        $order = Order::findOrFail($id);
        
        if ($order->product->user_id !== Auth::id()) {
            return redirect()->back()->withErrors(['message' => 'Unauthorized action.']);
        }

        if ($order->status !== 'diproses') {
            return redirect()->back()->withErrors(['message' => 'Pesanan harus diproses terlebih dahulu.']);
        }

        $order->status = 'dikirim';
        $order->resi = $request->resi;
        $order->save();

        return redirect()->route('penjual.orders')->with('success', 'Resi berhasil diupdate. Barang sedang dikirim.');
    }

    // =========================================================
    // PEMBELI FLOW
    // =========================================================

    public function userOrders()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $recycles = Recycle::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('user.lacak', compact('orders', 'recycles'));
    }

    public function receiveOrder($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        if ($order->status !== 'dikirim') {
            return redirect()->back()->withErrors(['message' => 'Barang belum dikirim.']);
        }

        $order->status = 'selesai';
        $order->save();

        return redirect()->route('user.orders')->with('success', 'Barang telah diterima. Silakan beri rating dan review!');
    }

    public function submitReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string'
        ]);

        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        if ($order->status !== 'selesai') {
            return redirect()->back()->withErrors(['message' => 'Pesanan belum selesai.']);
        }

        $order->rating = $request->rating;
        $order->review = $request->review;
        $order->save();

        return redirect()->route('user.orders')->with('success', 'Terima kasih atas review Anda!');
    }
}
