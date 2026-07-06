@extends('layouts.app')
@section('title', 'Kontak — Bersih Kilat')

@section('content')
<section class="bk-pagehead">
    <div class="container d-flex align-items-center gap-3">
        <div class="bk-ring bk-ring-sm" aria-hidden="true"></div>
        <h1>Hubungi Kami</h1>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <div class="bk-card" style="max-width:480px;">
            <p style="font-size:14px; color:var(--bk-muted); margin-bottom:4px;">Email</p>
            <p style="font-weight:500; margin-bottom:16px;">info@bersihkilat.com</p>

            <p style="font-size:14px; color:var(--bk-muted); margin-bottom:4px;">Telepon</p>
            <p style="font-weight:500; margin-bottom:16px;">0812-3456-789</p>

            <p style="font-size:14px; color:var(--bk-muted); margin-bottom:4px;">Alamat</p>
            <p style="font-weight:500; margin-bottom:0;">Jl. Melati No. 10, Banjar</p>
        </div>
    </div>
</section>
@endsection
