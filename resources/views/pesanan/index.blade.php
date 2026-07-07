@extends('layouts.admin')

@section('title', 'Data Pesanan')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Data Pesanan</h2>
        <div class="d-flex gap-2">
            <a href="{{ url('/dashboard') }}" class="btn btn-bk-ghost">Dashboard</a>
            <a href="{{ route('pesanan.create') }}" class="btn btn-bk-primary">+ Tambah Pesanan</a>
        </div>
    </div>

    <div class="bk-card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Pelanggan</th>
                        <th>Layanan</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Petugas</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody id="pesananTable">
                    <tr><td colspan="8" class="text-center text-muted">Memuat data...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
}

const statusBadge = {
    diterima: 'bg-secondary',
    proses_cuci: 'bg-info',
    proses_setrika: 'bg-primary',
    siap_diambil: 'bg-warning text-dark',
    selesai: 'bg-success',
    dibatalkan: 'bg-danger',
};

fetch('/api/pesanans')
    .then(response => response.json())
    .then(data => {
        let html = '';
        if (data.length === 0) {
            html = '<tr><td colspan="8" class="text-center text-muted">Belum ada data pesanan</td></tr>';
        }
        data.forEach((pesanan, index) => {
            const qty = pesanan.layanan.satuan === 'kg'
                ? `${pesanan.berat_kg ?? 0} kg`
                : `${pesanan.jumlah_item ?? 0} item`;
            html += `
            <tr>
                <td>${index + 1}</td>
                <td><strong>${pesanan.pelanggan.nama}</strong></td>
                <td>${pesanan.layanan.nama_layanan}</td>
                <td>${qty}</td>
                <td>${formatRupiah(pesanan.total_harga)}</td>
                <td><span class="badge ${statusBadge[pesanan.status] ?? 'bg-secondary'}">${pesanan.status.replace('_', ' ')}</span></td>
                <td>${pesanan.user.name}</td>
                <td>
                    <a href="/pesanan/edit/${pesanan.id}" class="btn btn-bk-ghost btn-sm">Edit</a>
                    <button class="btn btn-outline-danger btn-sm" onclick="hapusPesanan(${pesanan.id})">Hapus</button>
                </td>
            </tr>
            `;
        });
        document.getElementById('pesananTable').innerHTML = html;
    });

function hapusPesanan(id) {
    if (!confirm('Yakin ingin menghapus pesanan ini?')) return;
    fetch(`/api/pesanans/${id}`, { method: 'DELETE' })
        .then(response => response.json())
        .then(() => location.reload());
}
</script>
@endsection
