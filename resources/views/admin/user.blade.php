@extends('layout.admin')
@section('title', 'User')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
<div class="persetujuan-container">
    
    @php
        $dummyUsers = [
            [
                'id' => 1,
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@example.com',
                'created_at' => '01 Jun 2026'
            ],
            [
                'id' => 2,
                'name' => 'Siti Rahma',
                'email' => 'siti.rahma@example.com',
                'created_at' => '28 Mei 2026'
            ],
            [
                'id' => 3,
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'created_at' => '15 Mei 2026'
            ],
            [
                'id' => 4,
                'name' => 'Diana Putri',
                'email' => 'diana.putri@example.com',
                'created_at' => '10 Mei 2026'
            ]
        ];
        $totalUsersDummy = count($dummyUsers);
    @endphp

    <div class="header-wrapper">
        <div>
            <h1 class="page-title">Manajemen User</h1>
            <p class="page-subtitle">Kelola pengguna yang terdaftar di sistem</p>
        </div>
        
        <div class="user-summary-card">
            <div class="summary-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="summary-text">
                <span class="summary-label">Total User</span>
                <span class="summary-count">{{ $totalUsersDummy }}</span>
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
                @foreach($dummyUsers as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <p class="project-name">{{ $user['name'] }}</p>
                        </td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['created_at'] }}</td>
                        <td>
                            <button type="button" class="btn-setujui">Detail</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection