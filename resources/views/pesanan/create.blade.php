@extends('layouts.admin')

@section('title', 'Tambah Pesanan')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Tambah Pesanan</h2>

    <div class="bk-card">
        <div id="formAlert" class="alert alert-danger d-none"></div>
        <form id="pesananForm">
            <div class="mb-3">
                <label class="form-label">Pelanggan</label>
                <select name="id_pelanggan" id="id_pelanggan" class="form-select" required>
                    <option value="">-- Pilih Pelanggan --</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Layanan</label>
                <select name="id_layanan" id="id_layanan" class="form-select" required onchange="toggleQtyField()">
                    <option value="">-- Pilih Layanan --</option>
                </select>
            </div>
            <div class="mb-3" id="beratField">
                <label class="form-label">Berat (kg)</label>
                <input type="number" name="berat_kg" id="berat_kg" step="0.01" class="form-control">
            </div>
            <div class="mb-3 d-none" id="itemField">
                <label class="form-label">Jumlah Item</label>
                <input type="number" name="jumlah_item" id="jumlah_item" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Estimasi Selesai</label>
                <input type="date" name="estimasi_selesai" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Catatan (opsional)</label>
                <textarea name="catatan" rows="2" class="form-control"></textarea>
            </div>
            {{-- Petugas yang login saat ini, diambil dari session('user_id') --}}
            <input type="hidden" name="id_user" value="{{ session('user_id') }}">
            <a href="{{ route('pesanan.index') }}" class="btn btn-bk-ghost">Kembali</a>
            <button type="submit" class="btn btn-bk-primary">Simpan</button>
        </form>
    </div>
</div>

<script>
let layananList = [];

fetch('/api/pelanggans')
    .then(response => response.json())
    .then(data => {
        const select = document.getElementById('id_pelanggan');
        data.forEach(pelanggan => {
            select.innerHTML += `<option value="${pelanggan.id}">${pelanggan.nama} - ${pelanggan.no_hp}</option>`;
        });
    });

fetch('/api/layanans')
    .then(response => response.json())
    .then(data => {
        layananList = data;
        const select = document.getElementById('id_layanan');
        data.forEach(layanan => {
            select.innerHTML += `<option value="${layanan.id}">${layanan.nama_layanan} (${layanan.satuan})</option>`;
        });
    });

function toggleQtyField() {
    const id = document.getElementById('id_layanan').value;
    const layanan = layananList.find(l => l.id == id);
    if (!layanan) return;
    document.getElementById('beratField').classList.toggle('d-none', layanan.satuan !== 'kg');
    document.getElementById('itemField').classList.toggle('d-none', layanan.satuan !== 'item');
}

document.getElementById('pesananForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    const payload = Object.fromEntries(formData.entries());

    fetch('/api/pesanans', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify(payload)
    })
    .then(async response => {
        const data = await response.json();
        if (!response.ok) throw data;
        window.location.href = "{{ route('pesanan.index') }}";
    })
    .catch(err => {
        const alertBox = document.getElementById('formAlert');
        alertBox.classList.remove('d-none');
        alertBox.textContent = err.message || 'Terjadi kesalahan, periksa kembali data yang diisi.';
    });
});
</script>
@endsection
