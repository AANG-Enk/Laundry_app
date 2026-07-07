@extends('layouts.admin')

@section('title', 'Data Pelanggan')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Data Pelanggan</h2>
        <div class="d-flex gap-2">
            <a href="{{ url('/dashboard') }}" class="btn btn-bk-ghost">Dashboard</a>
            <a href="{{ route('pelanggan.create') }}" class="btn btn-bk-primary">+ Tambah Pelanggan</a>
        </div>
    </div>

    <div class="bk-card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody id="pelangganTable">
                    <tr><td colspan="6" class="text-center text-muted">Memuat data...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
fetch('/api/pelanggans')
    .then(response => response.json())
    .then(data => {
        let html = '';
        if (data.length === 0) {
            html = '<tr><td colspan="6" class="text-center text-muted">Belum ada data pelanggan</td></tr>';
        }
        data.forEach((pelanggan, index) => {
            html += `
            <tr>
                <td>${index + 1}</td>
                <td><strong>${pelanggan.nama}</strong></td>
                <td>${pelanggan.no_hp}</td>
                <td>${pelanggan.email ?? '-'}</td>
                <td>${pelanggan.alamat}</td>
                <td>
                    <a href="/pelanggan/edit/${pelanggan.id}" class="btn btn-bk-ghost btn-sm">Edit</a>
                    <button class="btn btn-outline-danger btn-sm" onclick="hapusPelanggan(${pelanggan.id})">Hapus</button>
                </td>
            </tr>
            `;
        });
        document.getElementById('pelangganTable').innerHTML = html;
    });

function hapusPelanggan(id) {
    if (!confirm('Yakin ingin menghapus pelanggan ini?')) return;
    fetch(`/api/pelanggans/${id}`, { method: 'DELETE' })
        .then(response => response.json())
        .then(() => location.reload());
}
</script>
@endsection
