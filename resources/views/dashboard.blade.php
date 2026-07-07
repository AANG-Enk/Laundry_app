@extends('layouts.admin')

@section('title', 'Dashboard — Bersih Kilat')

@section('content')
<div class="container py-4">
    <h1 style="font-size:24px;">Selamat datang, {{ session('nama') }}</h1>
    <p style="color:var(--bk-muted); font-size:14px; margin-bottom:32px;">
        Kelola data pelanggan, layanan, dan pesanan laundry dari sini.
    </p>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="bk-card">
                <h5>Data Layanan</h5>
                <p>Jenis layanan cuci, setrika, dan dry-clean.</p>
                <a href="{{ route('layanan.index') }}" class="btn btn-bk-primary mt-3">Kelola Layanan</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bk-card">
                <h5>Data Pelanggan</h5>
                <p>Data pelanggan yang terdaftar.</p>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-bk-primary mt-3">Kelola Pelanggan</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bk-card">
                <h5>Data Pesanan</h5>
                <p>Transaksi pesanan laundry masuk.</p>
                <a href="{{ route('pesanan.index') }}" class="btn btn-bk-primary mt-3">Kelola Pesanan</a>
            </div>
        </div>
    </div>
</div>
@endsection
