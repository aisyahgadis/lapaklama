@extends('layout.admin')

@section('title', 'Persetujuan Penjual')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/persetujuan.css') }}">
    
    <div class="persetujuan-container">
        <div class="total-pending-badge">
            Menunggu Persetujuan: <strong>2 Toko</strong>
        </div>
        <div class="page-header">
            <h1 class="page-title">Persetujuan Penjual</h1>
            <p class="page-subtitle">Kelola dan setujui toko yang mengajukan pendaftaran sebagai penjual baru.</p>
        </div>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nama Toko / Pemilik</th>
                        <th>Kategori</th>
                        <th>Dokumen</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p class="project-name">Toko Elektronik Maju</p>
                            <span class="project-deadline">Pemilik: Budi Santoso</span>
                        </td>
                        <td>
                            <span>Elektronik</span>
                        </td>
                        <td>
                            <a href="#" class="select-penjahit" style="text-decoration: none; display: inline-block; text-align: center; width: auto;">
                                Lihat Dokumen KTP/SIUP
                            </a>
                        </td>
                        <td class="text-center">
                            <button class="btn-setujui">Setujui</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="project-name">Sneakers Hype</p>
                            <span class="project-deadline">Pemilik: Andi Wijaya</span>
                        </td>
                        <td>
                            <span>Fashion & Shoes</span>
                        </td>
                        <td>
                            <a href="#" class="select-penjahit" style="text-decoration: none; display: inline-block; text-align: center; width: auto;">
                                Lihat Dokumen KTP/SIUP
                            </a>
                        </td>
                        <td class="text-center">
                            <button class="btn-setujui">Setujui</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection