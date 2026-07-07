@extends('layouts.admin')

@section('title', 'Tambah Pelanggan')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Tambah Pelanggan</h2>

    <div class="bk-card">
        <div id="formAlert" class="alert alert-danger d-none"></div>
        <form id="pelangganForm">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">No. HP</label>
                <input type="text" name="no_hp" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email (opsional)</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" rows="3" class="form-control" required></textarea>
            </div>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-bk-ghost">Kembali</a>
            <button type="submit" class="btn btn-bk-primary">Simpan</button>
        </form>
    </div>
</div>

<script>
document.getElementById('pelangganForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    const payload = Object.fromEntries(formData.entries());

    fetch('/api/pelanggans', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify(payload)
    })
    .then(async response => {
        const data = await response.json();
        if (!response.ok) throw data;
        window.location.href = "{{ route('pelanggan.index') }}";
    })
    .catch(err => {
        const alertBox = document.getElementById('formAlert');
        alertBox.classList.remove('d-none');
        alertBox.textContent = err.message || 'Terjadi kesalahan, periksa kembali data yang diisi.';
    });
});
</script>
@endsection
