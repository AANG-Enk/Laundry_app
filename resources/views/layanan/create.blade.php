@extends('layouts.admin')

@section('title', 'Tambah Layanan')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Tambah Layanan</h2>

    <div class="bk-card">
        <div id="formAlert" class="alert alert-danger d-none"></div>
        <form id="layananForm">
            <div class="mb-3">
                <label class="form-label">Nama Layanan</label>
                <input type="text" name="nama_layanan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="kiloan">Cuci Kiloan</option>
                    <option value="setrika_express">Cuci Setrika Express</option>
                    <option value="dry_cleaning">Dry Cleaning</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" step="0.01" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Satuan</label>
                <select name="satuan" class="form-select" required>
                    <option value="kg">Per Kilogram</option>
                    <option value="item">Per Item</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Estimasi Waktu (jam)</label>
                <input type="number" name="estimasi_jam" class="form-control" value="24">
            </div>
            <a href="{{ route('layanan.index') }}" class="btn btn-bk-ghost">Kembali</a>
            <button type="submit" class="btn btn-bk-primary">Simpan</button>
        </form>
    </div>
</div>

<script>
document.getElementById('layananForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    const payload = Object.fromEntries(formData.entries());

    fetch('/api/layanans', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify(payload)
    })
    .then(async response => {
        const data = await response.json();
        if (!response.ok) throw data;
        window.location.href = "{{ route('layanan.index') }}";
    })
    .catch(err => {
        const alertBox = document.getElementById('formAlert');
        alertBox.classList.remove('d-none');
        alertBox.textContent = err.message || 'Terjadi kesalahan, periksa kembali data yang diisi.';
    });
});
</script>
@endsection
