@extends('layout.admin')
@section('title','Detail Daur Ulang')
@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-recycle.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="persetujuan-container">
    <div class="total-pending-badge">
        Menunggu Penjahit: <strong>{{ $recycles->count() }} Project</strong>
    </div>
    <div class="header-section">
        <h1 class="page-title">Persetujuan Penjahit</h1>
        <p class="page-subtitle">Kelola dan setujui penjahit untuk project yang tersedia.</p>
    </div>

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama Project</th>
                    <th>Kategori</th>
                    <th>Kandidat Penjahit</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recycles as $recycle)
                <tr>
                    <td>
                        <p class="project-name">Ide Daur Ulang #{{ $recycle->id }}</p>
                        <span class="project-deadline">Diajukan: {{ $recycle->created_at->format('d M Y') }}</span>
                    </td>
                    <td>{{ Str::limit($recycle->deskripsi, 40) }}</td>
                    <td>
                        <form action="{{ route('admin.persetujuan.pilih') }}" method="POST" id="form-project-{{ $recycle->id }}">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $recycle->id }}">
                            <select name="penjahit_id" class="select-penjahit" required>
                                <option value="" selected disabled>-- Pilih Penjahit --</option>
                                @foreach($penjahits as $penjahit)
                                    <option value="{{ $penjahit->id }}">{{ $penjahit->nama }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td class="text-center">
                        <button type="submit" form="form-project-{{ $recycle->id }}" class="btn-setujui">
                            Setujui
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center" style="padding: 20px;">
                        Saat ini tidak ada project daur ulang yang membutuhkan penjahit.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection