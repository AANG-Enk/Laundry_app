@extends('layouts.app')
@section('title', 'Tentang Kami — Bersih Kilat')

@section('content')
<section class="bk-pagehead">
    <div class="container d-flex align-items-center gap-3">
        <div class="bk-ring bk-ring-sm" aria-hidden="true"></div>
        <h1>Tentang Bersih Kilat</h1>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-7">
                <p style="font-size:15px; color:var(--bk-muted); line-height:1.8;">
                    Bersih Kilat berdiri sejak 2022, melayani jasa cuci dan setrika untuk
                    warga sekitar dengan layanan antar-jemput gratis dalam radius 3 km.
                    Kami percaya laundry itu harusnya soal kepastian: kapan selesai,
                    berapa biayanya, dan pakaian pulang dalam kondisi terbaik.
                </p>
                <p style="font-size:15px; color:var(--bk-muted); line-height:1.8;">
                    Setiap pesanan dicatat dan dilacak dari drop-off sampai antar balik,
                    supaya tidak ada cerita "cucian ketuker" atau "lupa dijemput".
                </p>
            </div>
            <div class="col-md-5">
                <div class="bk-card">
                    <h5>Kenapa pilih kami?</h5>
                    <ul style="font-size:14px; color:var(--bk-muted); padding-left:18px; margin-bottom:0;">
                        <li>Estimasi waktu selesai jelas di awal</li>
                        <li>Antar-jemput gratis radius 3 km</li>
                        <li>Deterjen ramah kulit &amp; wangi tahan lama</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
