@extends('layout.web')
@section('title','tracking')
@section('content')
<link rel="stylesheet" href="{{ asset('css/tracking.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="tracking-page">
    <div class="tracking-container">
        
        <div class="tracking-grid">
            
            <div class="tracking-card">
                <h3>Project Daur Ulangmu</h3>
                
                <img src="https://images.unsplash.com/photo-1544816155-12df9643f363?q=80&w=500" alt="Baju Saya" class="summary-img">
                
                <span class="status-badge"><i class="bi bi-hourglass-split me-1"></i> Mencari Penjahit</span>
                
                <div style="margin-bottom: 15px;">
                    <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase;">Jenis Permintaan</small>
                    <p style="color: var(--text-dark); margin: 3px 0 0 0; font-size: 0.95rem;">Daur Ulang Celana Jeans menjadi Totebag.</p>
                </div>

                <div>
                    <small style="color: #94a3b8; font-weight: 600; text-transform: uppercase;">Tanggal Diajukan</small>
                    <p style="color: var(--text-dark); margin: 3px 0 0 0; font-size: 0.95rem;">{{ date('d M Y') }}</p>
                </div>
            </div>

            <div class="tracking-card">
                <h3>Status Pengerjaan</h3>
                
                <ul class="timeline">
                    
                    <li class="timeline-item completed">
                        <div class="timeline-icon"><i class="bi bi-check-lg"></i></div>
                        <div class="timeline-content">
                            <h4>Ide Diterima</h4>
                            <p>Formulir dan foto bajumu berhasil dikirim ke sistem Lapak Lama.</p>
                        </div>
                    </li>

                    <li class="timeline-item current">
                        <div class="timeline-icon"><i class="bi bi-person-search"></i></div>
                        <div class="timeline-content">
                            <h4>Pemilihan Penjahit Terbaik</h4>
                            <p>Admin Lapak Lama sedang mencocokkan bahan pakaianmu dengan penjahit spesialis kami. (Estimasi: Max 24 Jam).</p>
                        </div>
                    </li>

                    <li class="timeline-item">
                        <div class="timeline-icon"><i class="bi bi-truck"></i></div>
                        <h4>Kirim Baju ke Workshop</h4>
                        <p>Silakan kirim pakaian bekasmu ke alamat workshop kami di bawah ini:</p>

                        <!-- Kotak Alamat & Input Resi (Hanya muncul jika sudah disetujui admin) -->
                        <div style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 12px; padding: 15px; margin-top: 10px;">
                            <small style="font-weight: bold; color: #0b5f75;">Alamat Workshop:</small>
                            <p style="font-size: 0.85rem; margin: 3px 0 15px 0; color: #334155;">
                                <strong>Lapak Lama Fashion Centre (UP: Penjahit Pak Joko)</strong><br>
                                Jl. Tekstil Raya No. 45, Kecamatan Kebayoran Baru, Jakarta Selatan, 12110.
                            </p>

                            <!-- Form Simpel Input Resi -->
                            <form action="#" method="POST">
                                @csrf
                                <label style="font-size: 0.85rem; font-weight: 600; color: #334155; display: block; margin-bottom: 5px;">
                                    Sudah Kirim? Masukkan Nomor Resi Kurir:
                                </label>
                                <div style="display: flex; gap: 10px;">
                                    <input type="text" name="nomor_resi" placeholder="Contoh: JNE123456789" class="form-control" style="padding: 8px 12px; font-size: 0.9rem;" required>
                                    <button type="submit" class="btn-submit" style="width: auto; padding: 8px 20px; font-size: 0.9rem; border-radius: 10px;">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </li>

                    <li class="timeline-item">
                        <div class="timeline-icon"><i class="bi bi-scissors"></i></div>
                        <div class="timeline-content">
                            <h4>Proses Daur Ulang</h4>
                            <p>Pakaianmu sedang dibongkar dan dijahit ulang oleh mitra profesional kami.</p>
                        </div>
                    </li>

                </ul>
            </div>

        </div>

    </div>
</div>
@endsection