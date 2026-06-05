@extends('layout.admin')

@section('title', 'Data Produk')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
<div class="container-fluid">
    
    <div class="page-header">
        <div class="header-title">
            <h2>Manajemen Produk</h2>
            <p>Kelola produk yang terdaftar di sistem</p>
        </div>
        
        <div class="counter-card">
            <div class="counter-icon"></div>
            <div class="counter-info">
                <span class="counter-label">TOTAL PRODUK</span>
                <span class="counter-value">4</span>
            </div>
        </div>
    </div>

    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width: 8%;">NO</th>
                    <th style="width: 25%;">NAMA PRODUK</th>
                    <th style="width: 20%;">KATEGORI</th>
                    <th style="width: 18%;">HARGA</th>
                    <th style="width: 14%;">STOK</th>
                    <th style="width: 15%;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td class="fw-bold">Laptop ASUS ROG</td>
                    <td>Elektronik</td>
                    <td>Rp 18.500.000</td>
                    <td>12 Pcs</td>
                    <td>
                        <button class="btn-detail">Detail</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td class="fw-bold">Smartphone Samsung S24</td>
                    <td>Elektronik</td>
                    <td>Rp 15.200.000</td>
                    <td>8 Pcs</td>
                    <td>
                        <button class="btn-detail">Detail</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td class="fw-bold">Meja Kerja Minimalis</td>
                    <td>Furnitur</td>
                    <td>Rp 850.000</td>
                    <td>25 Pcs</td>
                    <td>
                        <button class="btn-detail">Detail</button>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td class="fw-bold">Kemeja Flanel Premium</td>
                    <td>Pakaian</td>
                    <td>Rp 249.000</td>
                    <td>50 Pcs</td>
                    <td>
                        <button class="btn-detail">Detail</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection