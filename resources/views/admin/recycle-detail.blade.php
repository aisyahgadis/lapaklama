@extends('layout.admin')
@section('title','Detail Daur Ulang')
@section('content')
<link rel="stylesheet" href="{{ asset('css/admin-recycle.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="persetujuan-container">
    <div class="total-pending-badge">
        Menunggu Persetujuan: <strong>2 Penjahit</strong>
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
                <tr>
                    <td>
                        <p class="project-name">Project Jaket Bomber Custom</p>
                        <span class="project-deadline">Deadline: 20 Juni 2026</span>
                    </td>
                    <td>Pakaian Pria</td>
                    <td>
                        <form action="{{ route('admin.persetujuan.pilih') }}" method="POST" id="form-project-1">
                            @csrf
                            <input type="hidden" name="project_id" value="1">
                            <select name="penjahit_id" class="select-penjahit">
                                <option value="" selected disabled>-- Pilih Penjahit --</option>
                                <option value="101">Penjahit Ahmad (Rating: 4.8)</option>
                                <option value="102">Penjahit Siti (Rating: 4.9)</option>
                                <option value="103">Roni Tailor (Rating: 4.5)</option>
                            </select>
                        </form>
                    </td>
                    <td class="text-center">
                        <button type="submit" form="form-project-1" class="btn-setujui">
                            Setujui
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p class="project-name">Gaun Pesta Silk</p>
                        <span class="project-deadline">Deadline: 05 Juli 2026</span>
                    </td>
                    <td>Pakaian Wanita</td>
                    <td>
                        <form action="{{ route('admin.persetujuan.pilih') }}" method="POST" id="form-project-2">
                            @csrf
                            <input type="hidden" name="project_id" value="2">
                            <select name="penjahit_id" class="select-penjahit">
                                <option value="" selected disabled>-- Pilih Penjahit --</option>
                                <option value="104">Batik & Kebaya Indah (Rating: 4.7)</option>
                                <option value="102">Penjahit Siti (Rating: 4.9)</option>
                            </select>
                        </form>
                    </td>
                    <td class="text-center">
                        <button type="submit" form="form-project-2" class="btn-setujui">
                            Setujui
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection