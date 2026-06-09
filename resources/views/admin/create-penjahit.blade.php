@extends('layout.admin')
@section('title', 'Tambah Penjahit')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-recycle.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="persetujuan-container">
    <div style="margin-bottom: 24px;">
        <a href="{{ route('admin.recycle-detail') }}" style="text-decoration: none; color: #718096; display: flex; align-items: center; gap: 8px; margin-bottom: 16px; font-size: 14px;">
            <i class="bi bi-arrow-left"></i> Kembali ke Kelola Daur Ulang
        </a>
        <h1 class="page-title">Tambah Penjahit Baru</h1>
        <p class="page-subtitle">Isi data penjahit berikut untuk ditambahkan ke sistem</p>
    </div>

    <div id="message-container"></div>

    <div style="max-width: 600px; background: #ffffff; padding: 32px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
        <form id="form-tambah-penjahit">
            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #2d3748; font-size: 14px;">Nama Penjahit</label>
                <input type="text" name="nama" id="nama" required class="select-penjahit" style="font-size: 14px; padding: 10px 14px;">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #2d3748; font-size: 14px;">Email</label>
                <input type="email" name="email" id="email" required class="select-penjahit" style="font-size: 14px; padding: 10px 14px;">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #2d3748; font-size: 14px;">Password</label>
                <input type="password" name="password" id="password" required class="select-penjahit" style="font-size: 14px; padding: 10px 14px;">
            </div>

            <div style="margin-bottom: 32px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #2d3748; font-size: 14px;">Nomor HP</label>
                <input type="text" name="no_hp" id="no_hp" required class="select-penjahit" style="font-size: 14px; padding: 10px 14px;">
            </div>

            <div style="display: flex; gap: 12px;">
                <a href="{{ route('admin.recycle-detail') }}" style="flex: 1; padding: 12px 16px; text-align: center; border: 1px solid #e2e8f0; border-radius: 6px; text-decoration: none; color: #4a5568; font-weight: 600; font-size: 14px; transition: all 0.2s;">
                    Batal
                </a>
                <button type="submit" id="btn-simpan" class="btn-setujui" style="flex: 1; font-size: 14px; padding: 12px 16px;">
                    <i class="bi bi-save"></i> Simpan Penjahit
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('form-tambah-penjahit').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const btnSimpan = document.getElementById('btn-simpan');
    const messageContainer = document.getElementById('message-container');
    
    // Disable button and show loading
    btnSimpan.disabled = true;
    btnSimpan.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyimpan...';
    
    // Clear previous messages
    messageContainer.innerHTML = '';
    
    try {
        const response = await fetch('/api/penjahit', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                nama: document.getElementById('nama').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                no_hp: document.getElementById('no_hp').value
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Show success message
            messageContainer.innerHTML = `
                <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                    <i class="bi bi-check-circle"></i> ${data.message}
                </div>
            `;
            
            // Reset form
            this.reset();
            
            // Redirect after 2 seconds
            setTimeout(() => {
                window.location.href = '{{ route('admin.recycle-detail') }}';
            }, 2000);
        } else {
            // Show error message
            let errorMsg = data.message || 'Terjadi kesalahan';
            if (data.errors) {
                errorMsg = Object.values(data.errors).flat().join(', ');
            }
            messageContainer.innerHTML = `
                <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                    <i class="bi bi-exclamation-triangle"></i> ${errorMsg}
                </div>
            `;
        }
    } catch (error) {
        messageContainer.innerHTML = `
            <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                <i class="bi bi-exclamation-triangle"></i> Terjadi kesalahan jaringan
            </div>
        `;
    } finally {
        // Re-enable button
        btnSimpan.disabled = false;
        btnSimpan.innerHTML = '<i class="bi bi-save"></i> Simpan Penjahit';
    }
});
</script>

@endsection
