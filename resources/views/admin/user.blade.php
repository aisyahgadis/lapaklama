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

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal Bergabung</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="font-semibold">{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-action btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn-action btn-delete" title="Hapus"><i class="fas fa-trash"></i></a>
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