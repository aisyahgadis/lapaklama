@extends('layout.admin')
@section('title', 'Persetujuan Penjual')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/persetujuan.css') }}">

<div class="persetujuan-container">
    <div class="header-wrapper" style="margin-bottom: 24px;">
        <h2 class="page-title">Persetujuan Penjual Baru</h2>
        <p class="page-subtitle">Kelola pendaftaran toko baru dari calon penjual</p>
    </div>

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Toko</th>
                    <th>Nama Pemilik</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($daftarPenjual as $penjual)
                    <tr>
                        <td>#{{ $penjual->id }}</td>
                        <td>{{ $penjual->nama_toko }}</td>
                        <td>{{ $penjual->nama }}</td>
                        <td>{{ $penjual->created_at->format('d M Y') }}</td>
                        <td class="action-buttons" style="display: flex; gap: 8px;">
                            <form action="{{ route('admin.user.approve', $penjual->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-setujui" onclick="return confirm('Yakin ingin menyetujui pendaftaran ini?')">Setujui</button>
                            </form>
                            <form action="{{ route('admin.user.destroy', $penjual->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="background-color: #e53e3e; color: white; border: none; padding: 8px 16px; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 12px;" onclick="return confirm('Yakin ingin menolak dan menghapus pendaftar ini?')">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 20px;">
                            Saat ini belum ada pengajuan penjual baru.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

@endsection