@extends('layouts.admin')

@section('title', 'Data Layanan')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Data Layanan</h2>
        <div class="d-flex gap-2">
            <a href="{{ url('/dashboard') }}" class="btn btn-bk-ghost">Dashboard</a>
            <a href="{{ route('layanan.create') }}" class="btn btn-bk-primary">+ Tambah Layanan</a>
        </div>
    </div>

    <div class="bk-card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Layanan</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Satuan</th>
                        <th>Estimasi</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody id="layananTable">
                    <tr><td colspan="7" class="text-center text-muted">Memuat data...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
}

fetch('/api/layanans')
    .then(async response => {
        const data = await response.json();
        if (!response.ok) {
            // Lempar objek berisi status code asli supaya bisa ditampilkan di .catch()
            throw { status: response.status, body: data };
        }
        return data;
    })
    .then(data => {
        let html = '';
        if (data.length === 0) {
            html = '<tr><td colspan="7" class="text-center text-muted">Belum ada data layanan</td></tr>';
        }
        data.forEach((layanan, index) => {
            html += `
            <tr>
                <td>${index + 1}</td>
                <td><strong>${layanan.nama_layanan}</strong></td>
                <td><span class="badge bg-secondary">${layanan.kategori.replace('_', ' ')}</span></td>
                <td>${formatRupiah(layanan.harga)}</td>
                <td>${layanan.satuan}</td>
                <td>${layanan.estimasi_jam} jam</td>
                <td>
                    <a href="/layanan/edit/${layanan.id}" class="btn btn-bk-ghost btn-sm">Edit</a>
                    <button class="btn btn-outline-danger btn-sm" onclick="hapusLayanan(${layanan.id})">Hapus</button>
                </td>
            </tr>
            `;
        });
        document.getElementById('layananTable').innerHTML = html;
    })
    .catch(err => {
        console.error('Gagal memuat /api/layanans:', err);
        const status = err.status ?? '?';
        const message = err.body?.message ?? err.message ?? 'Kesalahan tidak diketahui';
        document.getElementById('layananTable').innerHTML =
            `<tr><td colspan="7" class="text-center text-danger">
                Gagal memuat data (HTTP ${status}): ${message}<br>
                <small class="text-muted">Buka Console browser (F12) untuk detail lengkap.</small>
            </td></tr>`;
    });

function hapusLayanan(id) {
    if (!confirm('Yakin ingin menghapus layanan ini?')) return;
    fetch(`/api/layanans/${id}`, { method: 'DELETE' })
        .then(response => response.json())
        .then(() => location.reload());
}
</script>
@endsection
