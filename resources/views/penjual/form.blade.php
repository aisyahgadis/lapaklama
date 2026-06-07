@extends('layout.web')
@section('title','form')
@section('content')
<!-- Hubungkan ke CSS Form -->
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<!-- Pastikan kamu pakai Bootstrap Icons untuk icon-nya -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="form-page">
    <div class="form-container">
        
        <!-- Progress Tracker -->
        <div class="progress-tracker">
            <div class="tracker-step active">
                <div class="step-number">1</div>
                <div class="step-text">Detail Baju</div>
            </div>
            <div class="tracker-step">
                <div class="step-number">2</div>
                <div class="step-text">Pemilihan Penjahit</div>
            </div>
            <div class="tracker-step">
                <div class="step-number">3</div>
                <div class="step-text">Proses & Kirim</div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <h2>Mulai Project Daur Ulangmu</h2>
            <p class="subtitle">Pilih kreasi populer atau tentukan sendiri ide daur ulang pakaianmu.</p>

            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- INPUT 1: TEMPLATE KREASI POPULER (Ide Gabungan) -->
                <div class="form-group">
                    <label for="templateSelect"><i class="bi bi-stars text-warning me-1"></i> Mau Dibuat Jadi Apa?</label>
                    <select id="templateSelect" name="category" class="form-control">
                        <option value="custom" data-price="0" data-desc="">-- Punya Ide Sendiri (Custom) --</option>
                        <option value="jeans-totebag" data-price="75000" data-desc="Saya ingin mendaur ulang celana jeans bekas saya menjadi sebuah tas Totebag yang kokoh untuk kuliah. Tolong pertahankan bagian saku belakang celananya untuk dijadikan saku luar tas ya.">Celana Jeans bekas ➔ Jadi Totebag Estetik (Rp 75.000)</option>
                        <option value="kemeja-jacket" data-price="110000" data-desc="Saya punya beberapa kemeja bekas yang sudah sempit. Saya ingin menggabungkannya dengan metode patchwork menjadi sebuah Jaket Outer casual bertekstur kemeja flanel.">Kemeja/Flanel bekas ➔ Jadi Jaket Patchwork (Rp 110.000)</option>
                        <option value="kaos-pouch" data-price="45000" data-desc="Saya ingin mendaur ulang kaos katun lama saya menjadi dompet kecil (Utility Pouch) serbaguna untuk menyimpan kabel charger atau make-up ringan.">Kaos Katun bekas ➔ Jadi Pouch Serbaguna (Rp 45.000)</option>
                    </select>
                </div>

                <!-- INPUT 2: UPLOAD FOTO -->
                <div class="form-group">
                    <label>Foto Pakaian Saat Ini</label>
                    <div class="upload-zone" id="uploadZone" onclick="document.getElementById('clothing-img').click()">
                        <i class="bi bi-cloud-arrow-up" id="uploadIcon"></i>
                        <p id="uploadText"><strong>Klik untuk upload</strong> atau seret foto bajumu di sini</p>
                        <p style="font-size: 0.75rem; color: #94a3b8; margin-top: 5px;">Format JPG, PNG (Maks. 5MB)</p>
                    </div>
                    <input type="file" name="image" id="clothing-img" class="file-input" required>
                </div>

                <!-- INPUT 3: DESKRIPSI (Otomatis Berubah Berdasarkan Template) -->
                <div class="form-group">
                    <label for="description">Detail Permintaan Tambahan</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        rows="5" 
                        class="form-control" 
                        placeholder="Tuliskan detail permintaanmu di sini..." 
                        required></textarea>
                </div>

                <!-- KOTAK LIVE ESTIMASI BIAYA (Versi Support Custom) -->
                <div class="price-estimation-box" id="priceBox">
                    <div>
                        <p class="price-title"><i class="bi bi-wallet2 me-1"></i> Estimasi Biaya Jasa</p>
                        <!-- Teks catatan ini akan berubah dinamis lewat JS -->
                        <small id="priceNote" style="color: var(--text-muted); font-size: 0.8rem;">*Belum termasuk ongkir fisik baju</small>
                    </div>
                    <div>
                        <p id="livePrice" class="price-amount">Rp 0</p>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn-submit">
                    Kirim Ide Daur Ulang <i class="bi bi-arrow-right ms-2"></i>
                    <a href="{{ route('penjual.tracking') }}" class="btn-submit">Lihat Tracking</a>
                </button>
            </form>
        </div>

    </div>
</div>

<script>
    const fileInput = document.getElementById('clothing-img');
    const uploadText = document.getElementById('uploadText');
    const uploadIcon = document.getElementById('uploadIcon');
    const uploadZone = document.getElementById('uploadZone');

    fileInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const fileName = this.files[0].name;
            // Mengubah teks menjadi nama file yang dipilih
            uploadText.innerHTML = `File terpilih: <strong>${fileName}</strong>`;
            // Mengubah icon menjadi centang hijau
            uploadIcon.className = "bi bi-check-circle-fill text-success";
            uploadZone.style.borderColor = "#2e7d32";
            uploadZone.style.background = "#f0fdf4";
        }
    });
    document.addEventListener('DOMContentLoaded', function () {
        const templateSelect = document.getElementById('templateSelect');
        const descriptionTextarea = document.getElementById('description');
        const livePriceDisplay = document.getElementById('livePrice');
        const priceNote = document.getElementById('priceNote');
        const priceBox = document.getElementById('priceBox');

        templateSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const price = parseInt(selectedOption.getAttribute('data-price'));
            const autoDesc = selectedOption.getAttribute('data-desc');

            // 1. Set Teks Deskripsi Otomatis
            descriptionTextarea.value = autoDesc;
            
            // 2. Logika Penentuan Harga & Catatan
            if (this.value === 'custom') {
                // Jika user milih Custom
                livePriceDisplay.innerText = "Bakal Direview";
                livePriceDisplay.style.fontSize = "1.2rem"; // Biar teksnya muat
                priceNote.innerHTML = "<span class='text-warning'><i class='bi bi-clock-history'></i> Biaya dihitung admin setelah form dikirim.</span>";
                priceBox.style.borderColor = "#f59e0b"; /* Ubah border jadi warna orange warning */
            } else {
                // Jika user milih Template Populer
                livePriceDisplay.innerText = "Rp " + price.toLocaleString('id-ID');
                livePriceDisplay.style.fontSize = "1.4rem"; // Kembalikan ukuran asli
                priceNote.innerText = "*Belum termasuk ongkir fisik baju";
                priceBox.style.borderColor = "#0b5f75"; /* Kembalikan ke warna teal utama */
            }
        });
    });
</script>
@endsection