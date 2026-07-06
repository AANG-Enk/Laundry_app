<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard — Bersih Kilat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<nav class="bk-navbar">
    <div class="container d-flex justify-content-between align-items-center">
        <span class="brand">bersih<span style="color:var(--bk-aqua);">kilat</span> · admin</span>
        <a href="/logout" class="btn btn-bk-ghost">Logout</a>
    </div>
</nav>

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
                <button class="btn btn-bk-ghost mt-3" disabled>Belum dibuat</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bk-card">
                <h5>Data Pelanggan</h5>
                <p>Data pelanggan yang terdaftar.</p>
                <button class="btn btn-bk-ghost mt-3" disabled>Belum dibuat</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="bk-card">
                <h5>Data Pesanan</h5>
                <p>Transaksi pesanan laundry masuk.</p>
                <button class="btn btn-bk-ghost mt-3" disabled>Belum dibuat</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
