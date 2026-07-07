@extends('layouts.admin')

@section('title', 'Data Layanan')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Data Layanan</h2>
        <div class="d-flex gap-2">
            <a href="{{ url('/dashboard') }}" class="btn btn-bk-ghost">Dashboard</a>
            <button type="button" class="btn btn-bk-ghost" data-bs-toggle="modal" data-bs-target="#importModal">
                Import Excel
            </button>
            <a href="{{ route('layanan.create') }}" class="btn btn-bk-primary">+ Tambah Layanan</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

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

{{-- Modal Upload Excel --}}
<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('layanan.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Import Data Layanan dari Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted" style="font-size: 14px;">
                        File harus punya kolom (baris pertama sebagai heading):
                        <code>nama_layanan, kategori, harga, satuan, estimasi_jam</code><br>
                        Nilai <code>kategori</code>: <code>kiloan</code> / <code>setrika_express</code> / <code>dry_cleaning</code>.
                        Nilai <code>satuan</code>: <code>kg</code> / <code>item</code>.
                    </p>
                    <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bk-ghost" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-bk-primary">Upload &amp; Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
}

fetch('/api/layanans')
    .then(response => response.json())
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
        document.getElementById('layananTable').innerHTML =
            '<tr><td colspan="7" class="text-center text-danger">Gagal memuat data. Cek console (F12).</td></tr>';
    });

function hapusLayanan(id) {
    if (!confirm('Yakin ingin menghapus layanan ini?')) return;
    fetch(`/api/layanans/${id}`, { method: 'DELETE' })
        .then(response => response.json())
        .then(() => location.reload());
}
</script>
@endsection
