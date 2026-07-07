@extends('layouts.admin')

@section('title', 'Edit Pesanan')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Pesanan</h2>

    <div class="bk-card">
        <div id="formAlert" class="alert alert-danger d-none"></div>
        <form id="pesananForm">
            <div class="mb-3">
                <label class="form-label">Pelanggan</label>
                <input type="text" id="namaPelanggan" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Layanan</label>
                <input type="text" id="namaLayanan" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="diterima">Diterima</option>
                    <option value="proses_cuci">Proses Cuci</option>
                    <option value="proses_setrika">Proses Setrika</option>
                    <option value="siap_diambil">Siap Diambil</option>
                    <option value="selesai">Selesai</option>
                    <option value="dibatalkan">Dibatalkan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Estimasi Selesai</label>
                <input type="date" name="estimasi_selesai" id="estimasi_selesai" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Catatan</label>
                <textarea name="catatan" id="catatan" rows="2" class="form-control"></textarea>
            </div>
            <a href="{{ route('pesanan.index') }}" class="btn btn-bk-ghost">Kembali</a>
            <button type="submit" class="btn btn-bk-primary">Update</button>
        </form>
    </div>
</div>

<script>
const id = {{ $id }};

fetch(`/api/pesanans/${id}`)
    .then(response => response.json())
    .then(pesanan => {
        document.getElementById('namaPelanggan').value = pesanan.pelanggan.nama;
        document.getElementById('namaLayanan').value = pesanan.layanan.nama_layanan;
        document.getElementById('status').value = pesanan.status;
        document.getElementById('estimasi_selesai').value = pesanan.estimasi_selesai;
        document.getElementById('catatan').value = pesanan.catatan ?? '';
    });

document.getElementById('pesananForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    const payload = Object.fromEntries(formData.entries());

    fetch(`/api/pesanans/${id}`, {
        method: 'PUT',
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
