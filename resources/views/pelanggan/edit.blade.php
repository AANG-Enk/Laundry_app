@extends('layouts.admin')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Pelanggan</h2>

    <div class="bk-card">
        <div id="formAlert" class="alert alert-danger d-none"></div>
        <form id="pelangganForm">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">No. HP</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email (opsional)</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3" class="form-control" required></textarea>
            </div>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-bk-ghost">Kembali</a>
            <button type="submit" class="btn btn-bk-primary">Update</button>
        </form>
    </div>
</div>

<script>
const id = {{ $id }};

fetch(`/api/pelanggans/${id}`)
    .then(response => response.json())
    .then(pelanggan => {
        document.getElementById('nama').value = pelanggan.nama;
        document.getElementById('no_hp').value = pelanggan.no_hp;
        document.getElementById('email').value = pelanggan.email ?? '';
        document.getElementById('alamat').value = pelanggan.alamat;
    });

document.getElementById('pelangganForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    const payload = Object.fromEntries(formData.entries());

    fetch(`/api/pelanggans/${id}`, {
        method: 'PUT',
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
