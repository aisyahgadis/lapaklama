@extends('layout.user')
@section('title','tracking')
@section('content')
<link rel="stylesheet" href="{{ asset('css/tracking.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="tracking-page">
    <div class="tracking-container">
        
        <div class="tracking-grid">
            
            <div class="tracking-card">
                <h3>Project Daur Ulangmu</h3>
                
                @if($recycle)
                    <img src="{{ asset('storage/' . $recycle->gambar) }}" alt="Baju Saya" class="summary-img" onerror="this.src='https://images.unsplash.com/photo-1544816155-12df9643f363?q=80&w=500'">
                    
                    <span class="status-badge">
                        <i class="bi {{ $recycle->status === 'menunggu_assign' ? 'bi-hourglass-split' : ($recycle->status === 'assigned' ? 'bi-person-check' : 'bi-check-circle') }} me-1"></i>
                        {{ $recycle->status === 'menunggu_assign' ? 'Mencari Penjahit' : ($recycle->status === 'assigned' ? 'Penjahit Ditemukan' : ucfirst($recycle->status)) }}
                    </span>
                    
                    <div style="margin-bottom: 15px;">
                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase;">Jenis Permintaan</small>
                        <p style="color: var(--text-dark); margin: 3px 0 0 0; font-size: 0.95rem;">{{ $recycle->deskripsi }}</p>
                    </div>

                    <div>
                        <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase;">Tanggal Diajukan</small>
                        <p style="color: var(--text-dark); margin: 3px 0 0 0; font-size: 0.95rem;">{{ $recycle->created_at->format('d M Y') }}</p>
                    </div>

                    @if($recycle->penjahit)
                        <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
                            <h4 style="font-size: 1rem; color: #334155; margin-bottom: 10px;">Profile Penjahit</h4>
                            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                                <div style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #1b7a8c, #0b5f75); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem;">
                                    {{ strtoupper(substr($recycle->penjahit->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <p style="margin: 0; font-weight: 600;">{{ $recycle->penjahit->nama }}</p>
                                    <p style="margin: 0; font-size: 0.85rem; color: #6b7280;">{{ $recycle->penjahit->no_hp ?? '-' }}</p>
                                </div>
                            </div>
                            <div style="background-color: #f0f7f9; border-radius: 10px; padding: 15px; margin-bottom: 15px;">
                                <p style="font-size: 0.9rem; color: #334155; margin: 0;">
                                    <strong>Tentang Penjahit:</strong><br>
                                    {{ $recycle->penjahit->portofolio ?? 'Penjahit profesional yang berpengalaman dalam mendaur ulang pakaian menjadi barang fashion baru dan berguna.' }}
                                </p>
                            </div>
                            @if($recycle->penjahit->no_hp)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $recycle->penjahit->no_hp) }}" target="_blank" style="display: inline-flex; align-items: center; gap: 8px; background: #25D366; color: white; padding: 10px 20px; border-radius: 25px; text-decoration: none; margin-top: 10px; font-weight: 600;">
                                    <i class="bi bi-whatsapp"></i> Hubungi Penjahit via WhatsApp
                                </a>
                            @endif
                        </div>
                    @endif
                @else
                    <p>Belum ada permintaan daur ulang.</p>
                    <a href="{{ route('user.user-form') }}" style="display: inline-block; margin-top: 15px; padding: 10px 20px; background: #0b5f75; color: white; border-radius: 10px; text-decoration: none;">Buat Permintaan</a>
                @endif
            </div>

            <div class="tracking-card">
                <h3>Status Pengerjaan</h3>
                
                @if($recycle)
                    @php
                        $statusIndex = 0;
                        if ($recycle->status == 'assigned') $statusIndex = 1;
                        if ($recycle->status == 'dikerjakan') $statusIndex = 2;
                        if ($recycle->status == 'dikirim' || $recycle->status == 'selesai') $statusIndex = 3;
                        
                        $isKirimSelesai = !empty($recycle->alamat_pengiriman) && !empty($recycle->kode_resi);
                    @endphp

                    <ul class="timeline">
                        
                        <li class="timeline-item completed">
                            <div class="timeline-icon"><i class="bi bi-check-lg"></i></div>
                            <div class="timeline-content">
                                <h4>Ide Diterima</h4>
                                <p>Formulir dan foto bajumu berhasil dikirim ke sistem Lapak Lama.</p>
                            </div>
                        </li>

                        <li class="timeline-item {{ $statusIndex >= 1 ? ($statusIndex > 1 ? 'completed' : 'current') : '' }}">
                            <div class="timeline-icon"><i class="bi bi-person-search"></i></div>
                            <div class="timeline-content">
                                <h4>Pemilihan Penjahit Terbaik</h4>
                                <p>Admin Lapak Lama sedang mencocokkan bahan pakaianmu dengan penjahit spesialis kami.</p>
                            </div>
                        </li>

                        <li class="timeline-item {{ $statusIndex >= 2 ? ($isKirimSelesai ? 'completed' : 'current') : '' }}">
                            <div class="timeline-icon"><i class="bi {{ $isKirimSelesai ? 'bi-check-lg' : 'bi-truck' }}"></i></div>
                            <div class="timeline-content">
                                <h4>Kirim Baju ke Workshop</h4>
                                <p>Silakan kirim pakaian bekasmu ke alamat workshop penjahit.</p>

                                @if($recycle->penjahit)
                                    <div style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 12px; padding: 15px; margin-top: 10px;">
                                        <small style="font-weight: bold; color: #0b5f75;">Alamat Workshop:</small>
                                        <p style="font-size: 0.85rem; margin: 3px 0 15px 0; color: #334155;">
                                            <strong>UP: {{ $recycle->penjahit->nama }}</strong><br>
                                            {{ $recycle->penjahit->alamat_toko ?? 'Alamat belum diatur' }}
                                        </p>

                                        <form action="{{ route('user.recycle.update-resi', $recycle->id) }}" method="POST">
                                            @csrf
                                            <label style="font-size: 0.85rem; font-weight: 600; color: #334155; display: block; margin-bottom: 5px;">
                                                Alamat Pengiriman Kamu:
                                            </label>
                                            <textarea name="alamat_pengiriman" rows="2" placeholder="Masukkan alamat kamu" class="form-control" style="padding: 8px 12px; font-size: 0.9rem; width: 100%; margin-bottom: 10px;" {{ $isKirimSelesai ? 'disabled' : '' }}>{{ $recycle->alamat_pengiriman }}</textarea>
                                            
                                            <label style="font-size: 0.85rem; font-weight: 600; color: #334155; display: block; margin-bottom: 5px;">
                                                Sudah Kirim? Masukkan Nomor Resi Kurir:
                                            </label>
                                            <div style="display: flex; gap: 10px;">
                                                <input type="text" name="kode_resi" placeholder="Contoh: JNE123456789" class="form-control" style="padding: 8px 12px; font-size: 0.9rem; flex: 1;" value="{{ $recycle->kode_resi }}" {{ $isKirimSelesai ? 'disabled' : '' }}>
                                                @if(!$isKirimSelesai)
                                                    <button type="submit" class="btn-submit" style="width: auto; padding: 8px 20px; font-size: 0.9rem; border-radius: 10px; border: none; background: #0b5f75; color: white;">
                                                        Simpan
                                                    </button>
                                                @else
                                                    <span style="color: #2e7d32; font-weight: bold; padding: 8px 12px; font-size: 0.9rem;">
                                                        <i class="bi bi-check-circle"></i> Sudah dikirim
                                                    </span>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </li>

                        <li class="timeline-item {{ $statusIndex >= 3 ? 'current' : '' }}">
                            <div class="timeline-icon"><i class="bi bi-scissors"></i></div>
                            <div class="timeline-content">
                                <h4>Proses Daur Ulang</h4>
                                <p>Pakaianmu sedang dibongkar dan dijahit ulang oleh mitra profesional kami.</p>
                            </div>
                        </li>

                    </ul>
                @endif
            </div>

        </div>

    </div>
</div>
@endsection
