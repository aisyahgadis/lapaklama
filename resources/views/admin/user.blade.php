@extends('layout.admin')
@section('title', 'Manajemen User')
@section('content')
<link rel="stylesheet" href="{{ asset('css/user-admin.css') }}">

<div class="persetujuan-container">
    
    <div class="header-wrapper">
        <div class="header-text">
            <h2 class="page-title">Manajemen User</h2>
            <p class="page-subtitle">Kelola pengguna yang terdaftar di sistem</p>
        </div>
        
        <div class="user-summary-card">
            <div class="summary-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="summary-text">
                <span class="summary-label">Total User</span>
                <span class="summary-count">{{ $totalUsers }}</span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
            <i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th width="15%">Role & Status</th>
                    <th>Tanggal Bergabung</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="font-semibold">{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->jenis === 'penjual')
                                <span style="padding:4px 8px; border-radius:4px; font-size:0.8rem; font-weight:bold; 
                                    background: {{ $user->status_penjual == 'pending' ? '#fff3cd' : '#d4edda' }}; 
                                    color: {{ $user->status_penjual == 'pending' ? '#856404' : '#155724' }}">
                                    Penjual ({{ ucfirst($user->status_penjual) }})
                                </span>
                            @else
                                <span style="padding:4px 8px; border-radius:4px; font-size:0.8rem; background:#e2e3e5; font-weight:bold;">
                                    {{ ucfirst($user->jenis) }}
                                </span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="action-buttons" style="display: flex; gap: 5px;">
                                @if($user->jenis === 'penjual' && $user->status_penjual === 'pending')
                                    <form action="{{ route('admin.user.approve', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-action" style="background:#28a745; color:white; border:none; padding: 5px 10px; border-radius: 4px; cursor: pointer;" title="Setujui Penjual">
                                            <i class="fas fa-check"></i> Setujui
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" style="border:none; cursor: pointer;" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center empty-state">
                            Tidak ada data user yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection