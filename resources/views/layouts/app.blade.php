<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KosFinder - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --merah: #C0392B;
            --biru: #2C3E6B;
            --krem: #F5F0E8;
        }
        body { background-color: var(--krem); font-family: 'Segoe UI', sans-serif; }
        .navbar { background-color: var(--biru) !important; }
        .navbar-brand span.kos   { color: white; font-weight: 800; font-size: 1.5rem; }
        .navbar-brand span.finder { color: var(--merah); font-weight: 800; font-size: 1.5rem; }
        .navbar-nav .nav-link { color: rgba(255,255,255,.85) !important; }
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active { color: #fff !important; font-weight: 600; }
        .navbar-text { color: white !important; }
        .navbar-toggler { border-color: rgba(255,255,255,.3); }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
                <span class="kos">Kos</span><span class="finder">Finder</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                @auth
                    {{-- Nav untuk Pencari --}}
                    @if(auth()->user()->role === 'pencari')
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pencari.dashboard') ? 'active' : '' }}"
                               href="{{ route('pencari.dashboard') }}">
                                <i class="fas fa-home me-1"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pencari.kos.*') ? 'active' : '' }}"
                               href="{{ route('pencari.kos.index') }}">
                                <i class="fas fa-search me-1"></i>Cari Kos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pencari.favorit') ? 'active' : '' }}"
                               href="{{ route('pencari.favorit') }}">
                                <i class="fas fa-heart me-1"></i>Favorit
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pencari.review.index') ? 'active' : '' }}"
                            href="{{ route('pencari.review.index') }}">
                                <i class="fas fa-star me-1"></i>Review
                            </a>
                        </li>
                    </ul>
                    @endif

                    {{-- Nav untuk Owner --}}
                    @if(auth()->user()->role === 'owner')
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}"
                               href="{{ route('owner.dashboard') }}">
                                <i class="fas fa-building me-1"></i>Dashboard
                            </a>
                        </li>
                    </ul>
                    @endif
                @endauth

                <div class="ms-auto d-flex align-items-center gap-3">
                    @auth
                        <span class="navbar-text">
                            <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-sm text-white px-3"
                                    style="background-color: var(--merah); font-weight: 600; border-radius: 5px; font-size: 0.85rem;"
                                    onclick="event.preventDefault(); if(confirm('Yakin ingin keluar?')) { this.closest('form').submit(); }">
                                <i class="fas fa-sign-out-alt me-1"></i>Log Out
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
