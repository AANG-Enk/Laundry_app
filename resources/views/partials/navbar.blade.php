<nav class="bk-navbar">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="brand" href="{{ route('home') }}">
            bersih<span>kilat</span>
        </a>
        <div class="bk-pill-nav">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a>
            <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
        </div>
    </div>
</nav>
