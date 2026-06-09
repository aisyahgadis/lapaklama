@extends('layout.admin')
@section('title','Detail Daur Ulang')
@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-recycle.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
/* Notifikasi keren */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 16px 24px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 9999;
    display: none;
    align-items: center;
    gap: 12px;
    animation: slideIn 0.4s ease-out;
}
.notification.success {
    background: #d4edda;
    color: #155724;
    border-left: 4px solid #28a745;
}
.notification.error {
    background: #f8d7da;
    color: #721c24;
    border-left: 4px solid #dc3545;
}
.notification .icon {
    font-size: 20px;
}
.notification .text {
    font-size: 14px;
    font-weight: 600;
}
@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}
@keyframes slideOut {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(100%);
        opacity: 0;
    }
}
</style>

<div class="persetujuan-container">
    <!-- Notifikasi -->
    <div id="notification" class="notification">
        <i class="bi icon"></i>
        <span class="text"></span>
    </div>

    <div class="total-pending-badge">
        Menunggu Penjahit: <strong>{{ $recycles->where('status', 'menunggu_assign')->count() }} Project</strong>
    </div>
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px;">
        <div class="header-section">
            <h1 class="page-title">Kelola Daur Ulang</h1>
            <p class="page-subtitle">Kelola dan tugaskan penjahit untuk project yang tersedia.</p>
        </div>
        <a href="{{ route('admin.penjahit.create') }}" class="btn-setujui" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
            <i class="bi bi-plus-circle"></i> Tambah Penjahit
        </a>
    </div>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama Project</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Penjahit</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @forelse($recycles as $recycle)
                @php
                    // Tentukan style dan teks status
                    if ($recycle->status === 'menunggu_assign') {
                        $bgColor = '#fef3c7';
                        $textColor = '#92400e';
                        $statusText = 'Menunggu Penjahit';
                    } elseif ($recycle->status === 'assigned') {
                        $bgColor = '#dbeafe';
                        $textColor = '#1e40af';
                        $statusText = 'Sudah Ditugaskan';
                    } elseif ($recycle->status === 'dikerjakan') {
                        $bgColor = '#fff3cd';
                        $textColor = '#856404';
                        $statusText = 'Sedang Dikerjakan';
                    } else {
                        $bgColor = '#d1fae5';
                        $textColor = '#065f46';
                        $statusText = 'Selesai';
                    }
                @endphp
                <tr data-recycle-id="{{ $recycle->id }}">
                    <td>
                        <p class="project-name">Ide Daur Ulang</p>
                        <span class="project-deadline">Diajukan: {{ $recycle->created_at->format('d M Y') }}</span>
                    </td>
                    <td>{{ $recycle->kategori ? ucfirst($recycle->kategori) : 'Custom' }}</td>
                    <td>
                        <span style="padding: 4px 10px; border-radius: 15px; font-size: 0.85rem; background-color: {{ $bgColor }}; color: {{ $textColor }};">
                            {{ $statusText }}
                        </span>
                    </td>
                    <td>
                        @if($recycle->penjahit)
                            <strong>{{ $recycle->penjahit->nama }}</strong>
                            <p style="margin: 3px 0 0 0; font-size: 0.85rem; color: #6b7280;">
                                <i class="bi bi-telephone-fill"></i> {{ $recycle->penjahit->no_hp ?? '-' }}
                            </p>
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-center">
                        @if($recycle->status === 'menunggu_assign')
                            <form action="{{ route('admin.recycle.assign', $recycle->id) }}" method="POST" id="form-project-{{ $recycle->id }}" style="display: flex; gap: 10px; align-items: center;">
                                @csrf
                                <select name="penjahit_id" class="select-penjahit penjahit-select" required style="width: 180px;">
                                    <option value="" selected disabled>-- Pilih Penjahit --</option>
                                    @foreach($penjahits as $penjahit)
                                        <option value="{{ $penjahit->id }}">{{ $penjahit->nama }} ({{ $penjahit->no_hp ?? '-' }})</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn-setujui">Tugaskan</button>
                            </form>
                        @elseif($recycle->status !== 'selesai')
                            <form action="{{ route('admin.recycle.update-status', $recycle->id) }}" method="POST" class="form-update-status" data-recycle-id="{{ $recycle->id }}" style="display: flex; gap: 8px; align-items: center; justify-content: center;">
                                @csrf
                                <select name="status" class="select-penjahit" style="width: 160px;">
                                    @if($recycle->status === 'assigned')
                                        <option value="assigned" selected>Sudah Ditugaskan</option>
                                        <option value="dikerjakan">Sedang Dikerjakan</option>
                                        <option value="selesai">Selesai</option>
                                    @elseif($recycle->status === 'dikerjakan')
                                        <option value="dikerjakan" selected>Sedang Dikerjakan</option>
                                        <option value="selesai">Selesai</option>
                                    @endif
                                </select>
                                <button type="submit" class="btn-setujui">Update</button>
                            </form>
                        @else
                            <span style="color: #065f46; font-weight: bold;"><i class="bi bi-check-circle-fill"></i> Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 20px;">
                        Saat ini tidak ada project daur ulang.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async function() {
    // Fungsi menampilkan notifikasi
    function showNotification(type, message) {
        const notif = document.getElementById('notification');
        const icon = notif.querySelector('.icon');
        const text = notif.querySelector('.text');
        
        // Reset class
        notif.classList.remove('success', 'error');
        notif.classList.add(type);
        
        // Set icon
        icon.classList.remove('bi-check-circle-fill', 'bi-exclamation-triangle-fill');
        icon.classList.add(type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill');
        
        // Set pesan
        text.textContent = message;
        
        // Tampilkan
        notif.style.display = 'flex';
        
        // Sembunyikan setelah 3 detik
        setTimeout(() => {
            notif.style.animation = 'slideOut 0.4s ease-in forwards';
            setTimeout(() => {
                notif.style.display = 'none';
                notif.style.animation = '';
            }, 400);
        }, 3000);
    }

    // Muat penjahit dari API
    try {
        const response = await fetch('/api/penjahit');
        const data = await response.json();
        
        if (data.success && data.data) {
            const penjahits = data.data;
            const selects = document.querySelectorAll('.penjahit-select');
            
            selects.forEach(select => {
                select.innerHTML = '<option value="" selected disabled>-- Pilih Penjahit --</option>';
                penjahits.forEach(penjahit => {
                    const option = document.createElement('option');
                    option.value = penjahit.id;
                    option.textContent = penjahit.nama + (penjahit.no_hp ? ' (' + penjahit.no_hp + ')' : '');
                    select.appendChild(option);
                });
            });
        }
    } catch (error) {
        console.error('Gagal memuat data penjahit dari API, pakai fallback:', error);
    }

    // Tangani form update status via AJAX
    document.querySelectorAll('.form-update-status').forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            console.log('Form submitted! Data:', Object.fromEntries(formData));
            
            try {
                // Token CSRF sudah ada di formData (karena ada @csrf)
                // Kita pastikan dikirim dengan benar
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    credentials: 'same-origin',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                console.log('Response status:', response.status);
                
                let result;
                try {
                    result = await response.json();
                } catch (e) {
                    result = null;
                }
                
                if (response.ok && (result?.success)) {
                    // Berhasil, tampilkan notifikasi
                    showNotification('success', 'Status berhasil diperbarui!');
                    
                    // Update tampilan status di tabel
                    const newStatus = formData.get('status');
                    let statusText = '';
                    let statusColor = '';
                    let statusColorText = '';
                    
                    if (newStatus === 'assigned') {
                        statusText = 'Sudah Ditugaskan';
                        statusColor = '#dbeafe';
                        statusColorText = '#1e40af';
                    } else if (newStatus === 'dikerjakan') {
                        statusText = 'Sedang Dikerjakan';
                        statusColor = '#fff3cd';
                        statusColorText = '#856404';
                    } else if (newStatus === 'selesai') {
                        statusText = 'Selesai';
                        statusColor = '#d1fae5';
                        statusColorText = '#065f46';
                    }
                    
                    // Cari baris dan update
                    const tr = this.closest('tr');
                    const statusSpan = tr.querySelector('td:nth-child(3) span');
                    if (statusSpan) {
                        statusSpan.textContent = statusText;
                        statusSpan.style.backgroundColor = statusColor;
                        statusSpan.style.color = statusColorText;
                    }
                    
                    // Jika status selesai, ganti form dengan teks
                    if (newStatus === 'selesai') {
                        this.outerHTML = '<span style="color: #065f46; font-weight: bold;"><i class="bi bi-check-circle-fill"></i> Selesai</span>';
                    }
                } else {
                    // Tampilkan pesan error yang jelas
                    const errorMessage = result?.message || 'Gagal memperbarui status!';
                    console.error('Error:', errorMessage);
                    showNotification('error', errorMessage);
                }
            } catch (error) {
                console.error('Catch error:', error);
                showNotification('error', 'Terjadi kesalahan jaringan!');
            }
        });
    });
});
</script>
@endsection
