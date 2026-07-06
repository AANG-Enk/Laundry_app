<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Petugas — Bersih Kilat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="min-height:100vh; display:flex; align-items:center; justify-content:center;">

<div class="container" style="max-width:380px;">
    <div class="text-center mb-4">
        <div class="bk-ring bk-ring-sm mx-auto mb-3" aria-hidden="true"></div>
        <span class="brand" style="font-size:22px;">bersih<span style="color:var(--bk-aqua);">kilat</span></span>
        <p style="color:var(--bk-muted); font-size:14px; margin-top:4px;">Login Petugas</p>
    </div>

    <div class="bk-card">
        @if (session('error'))
            <div class="alert alert-danger py-2" style="font-size:14px; border-radius:10px;">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="mb-3">
                <label style="font-size:13px; color:var(--bk-muted);">Username</label>
                <input type="text" name="username" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label style="font-size:13px; color:var(--bk-muted);">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-bk-primary w-100">Masuk</button>
        </form>
    </div>
</div>

</body>
</html>
