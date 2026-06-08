@extends('layout.admin')
@section('title','Detail Daur Ulang')
@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-recycle.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="persetujuan-container">
    <div class="total-pending-badge">
        Menunggu Penjahit: <strong>{{ $recycles->where('status', 'menunggu_assign')->count() }} Project</strong>
    </div>
    <div class="header-section">
        <h1 class="page-title">Kelola Daur Ulang</h1>
        <p class="page-subtitle">Kelola dan tugaskan penjahit untuk project yang tersedia.</p>
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
            <tbody>
                @forelse($recycles as $recycle)
                <tr>
                    <td>
                        <p class="project-name">Ide Daur Ulang</p>
                        <span class="project-deadline">Diajukan: {{ $recycle->created_at->format('d M Y') }}</span>
                    </td>
                    <td>{{ $recycle->kategori ? ucfirst($recycle->kategori) : 'Custom' }}</td>
                    <td>
                        <span style="padding: 4px 10px; border-radius: 15px; font-size: 0.85rem; background-color: {{ $recycle->status === 'menunggu_assign' ? '#fef3c7' : ($recycle->status === 'assigned' ? '#dbeafe' : ($recycle->status === 'dikerjakan' ? '#fff3cd' : '#d1fae5')) }}; color: {{ $recycle->status === 'menunggu_assign' ? '#92400e' : ($recycle->status === 'assigned' ? '#1e40af' : ($recycle->status === 'dikerjakan' ? '#856404' : '#065f46')) }};">
                            {{ $recycle->status === 'menunggu_assign' ? 'Menunggu Penjahit' : ($recycle->status === 'assigned' ? 'Sudah Ditugaskan' : ($recycle->status === 'dikerjakan' ? 'Sedang Dikerjakan' : 'Selesai')) }}
                        </span>
                    </td>
                    <td>
                        @if($recycle->penjahit)
                            <strong>{{ $recycle->penjahit->nama }}</strong>
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-center">
                        @if($recycle->status === 'menunggu_assign')
                            <form action="{{ route('admin.recycle.assign', $recycle->id) }}" method="POST" id="form-project-{{ $recycle->id }}" style="display: flex; gap: 10px; align-items: center;">
                                @csrf
                                <select name="penjahit_id" class="select-penjahit" required style="width: 180px;">
                                    <option value="" selected disabled>-- Pilih Penjahit --</option>
                                    @foreach($penjahits as $penjahit)
                                        <option value="{{ $penjahit->id }}">{{ $penjahit->nama }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn-setujui">Tugaskan</button>
                            </form>
                        @elseif($recycle->status !== 'selesai')
                            <form action="{{ route('admin.recycle.update-status', $recycle->id) }}" method="POST" style="display: flex; gap: 8px; align-items: center; justify-content: center;">
                                @csrf
                                <select name="status" class="select-penjahit" style="width: 160px;">
                                    @if($recycle->status === 'assigned')
                                        <option value="assigned" selected>Sudah Ditugaskan</option>
                                        <option value="dikerjakan">Sedang Dikerjakan</option>
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
@endsection
