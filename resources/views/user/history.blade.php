@extends('layout.user')

{{-- Asumsi di layout.web kamu punya @yield('css') untuk taruh style tambahan --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('css/history.css') }}">
@endsection

@section('content')
<div class="history-container">
    <h2 class="history-title">Riwayat Belanja Kamu</h2>

    @if($transactions->isEmpty())
        <div class="empty-state">
            <p>Wah, kamu belum pernah belanja nih. Yuk jajan dulu!</p>
        </div>
    @else
        <div class="transaction-list">
            @foreach($transactions as $trx)
                <div class="transaction-card">
                    <div class="transaction-header">
                        <span class="trx-date">{{ $trx->created_at->format('d M Y') }}</span>
                        
                        {{-- Logika warna badge berdasarkan status --}}
                        @php
                            $badgeClass = 'badge-process'; // Default
                            if(strtolower($trx->status) == 'selesai') $badgeClass = 'badge-success';
                            if(strtolower($trx->status) == 'dibatalkan') $badgeClass = 'badge-danger';
                        @endphp
                        
                        <span class="trx-status {{ $badgeClass }}">
                            {{ ucfirst($trx->status) }}
                        </span>
                    </div>

                    <div class="transaction-body">
                        {{-- Asumsi setiap transaksi punya banyak item, kita tampilkan yang pertama saja sbg cover --}}
                        @if($trx->items->isNotEmpty())
                            <div class="trx-item-preview">
                                {{-- Ganti src dengan path gambarmu --}}
                                <img src="{{ asset('storage/' . $trx->items->first()->product->image) }}" alt="Produk" class="trx-img">
                                <div class="trx-item-info">
                                    <h4>{{ $trx->items->first()->product->name }}</h4>
                                    <p>{{ $trx->items->count() }} Barang</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="transaction-footer">
                        <div class="trx-total">
                            <small>Total Belanja</small>
                            <p>Rp {{ number_format($trx->total_price, 0, ',', '.') }}</p>
                        </div>
                        <div class="trx-action">
                            <a href="{{ route('transaction.detail', $trx->id) }}" class="btn-detail">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection