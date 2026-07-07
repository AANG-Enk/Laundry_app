<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Bersih Kilat Laundry')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<nav class="bk-navbar">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="{{ url('/dashboard') }}" class="brand">bersih<span style="color:var(--bk-aqua);">kilat</span> · admin</a>
        <a href="/logout" class="btn btn-bk-ghost">Logout</a>
    </div>
</nav>

<main>
    @yield('content')
</main>

{{-- Dibutuhkan supaya komponen Bootstrap Modal (dipakai di fitur Import Excel Modul 6) bisa jalan --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
