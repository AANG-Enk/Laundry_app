@extends('layouts.app')
@section('title', 'Bersih Kilat — Laundry Cepat & Bersih')

@section('content')
<section class="bk-hero">
    <div class="container d-flex align-items-center justify-content-between flex-wrap gap-4">
        <div>
            <span class="bk-badge">Antar-jemput gratis 3km</span>
            <h1>Cucianmu beres,<br>tanpa kamu ikut mikir.</h1>
            <p class="lead">
                Cuci, setrika, dan dry-clean dengan estimasi waktu yang jelas dari awal —
                bukan janji "nanti dikabarin".
            </p>
            <a href="{{ route('kontak') }}" class="btn btn-bk-primary">Jadwalkan Jemput</a>
            <a href="#layanan" class="btn btn-bk-ghost ms-2">Lihat Layanan</a>
        </div>
        <div class="bk-ring" aria-hidden="true"></div>
    </div>
</section>

<section id="layanan" class="py-5">
    <div class="container">
        <h2 class="mb-4">Layanan Kami</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="bk-card">
                    <h5>Cuci Kiloan</h5>
                    <p>Cuci + lipat rapi, selesai dalam 1 hari kerja.</p>
                    <div class="bk-price mt-3">Mulai Rp 7.000/kg</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bk-card">
                    <h5>Cuci Setrika Express</h5>
                    <p>Selesai dalam 6 jam, cocok untuk kebutuhan mendadak.</p>
                    <div class="bk-price mt-3">Mulai Rp 12.000/kg</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bk-card">
                    <h5>Dry Cleaning</h5>
                    <p>Untuk jas, gaun, dan pakaian berbahan khusus.</p>
                    <div class="bk-price mt-3">Mulai Rp 25.000/item</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
