@extends('layout.admin')
@section('title', 'Persetujuan Penjual')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/persetujuan.css') }}">

    <div class="persetujuan-header">
        <h2>Persetujuan Penjual Baru</h2>
    </div>

    <div class="card">
        <table class="table-approval">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Toko</th>
                    <th>Nama Pemilik</th>
                    <th>Dokumen</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($daftarPenjual as $penjual)
                    <tr>
                        <td>#{{ $penjual->id }}</td>
                        <td>{{ $penjual->nama_toko }}</td>
                        <td>{{ $penjual->nama_pemilik }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $penjual->dokumen) }}" target="_blank" class="link-doc">
                                Lihat Dokumen
                            </a>
                        </td>
                        <td>{{ $penjual->created_at->format('d M Y') }}</td>
                        <td class="action-buttons">
                            <button class="btn btn-approve">Setujui</button>
                            <button class="btn btn-reject">Tolak</button>
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
@endsection