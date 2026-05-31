<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KosFinder - Temukan Kos Terbaikmu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --merah: #C0392B;
            --biru: #2C3E6B;
            --krem: #F5F0E8;
        }
        body {
            background-color: var(--krem);
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background-color: var(--biru) !important;
            padding: 1rem 0;
        }
        .navbar-brand span.kos { color: white; font-weight: 800; font-size: 1.6rem; }
        .navbar-brand span.finder { color: var(--merah); font-weight: 800; font-size: 1.6rem; }
        
        .btn-custom-outline {
            color: white;
            border: 2px solid white;
            font-weight: 600;
            border-radius: 6px;
            transition: all 0.3s;
        }
        .btn-custom-outline:hover {
            background-color: white;
            color: var(--biru);
        }
        .btn-custom-solid {
            background-color: var(--merah);
            color: white;
            font-weight: 600;
            border-radius: 6px;
            padding: 0.6rem 1.5rem;
            border: none;
            transition: all 0.3s;
        }
        .btn-custom-solid:hover {
            background-color: #A93226;
            color: white;
            transform: translateY(-2px);
        }
        .hero-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
        }
        .hero-title {
            color: var(--biru);
            font-weight: 800;
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .hero-title span {
            color: var(--merah);
        }
        .hero-subtitle {
            color: #555;
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 2rem auto;
        }
        .card-preview {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            padding: 2.5rem;
            border: none;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">
                <span class="kos">Kos</span><span class="finder">Finder</span>
            </a>
            <div class="ms-auto">
                @if (Route::has('login'))
                    @auth
                        @if(Auth::user()->role === 'owner')
                            <a href="{{ url('/owner/dashboard') }}" class="btn btn-custom-outline px-4">Dashboard Owner</a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="btn btn-custom-outline px-4">Dashboard</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn text-white me-3 fw-semibold">Log In</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-custom-outline px-3 py-1.5">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <div class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card-preview">
                        <div class="mb-4">
                            <i class="fas fa-home fa-4x" style="color: var(--biru);"></i>
                        </div>
                        <h1 class="hero-title">Selamat Datang di <span>KosFinder</span></h1>
                        <p class="hero-subtitle">Platform modern untuk mempermudah pencarian dan pengelolaan kos-kosan dengan cepat, aman, dan terpercaya.</p>
                        
                        <div class="d-flex justify-content-center gap-3">
                            @auth
                                @if(Auth::user()->role === 'owner')
                                    <a href="{{ url('/owner/dashboard') }}" class="btn btn-custom-solid shadow-sm">
                                        <i class="fas fa-th-large me-2"></i> Masuk ke Dashboard Owner
                                    </a>
                                @else
                                    <a href="{{ url('/dashboard') }}" class="btn btn-custom-solid shadow-sm">
                                        <i class="fas fa-search me-2"></i> Mulai Cari Kos
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-custom-solid shadow-sm">
                                    <i class="fas fa-sign-in-alt me-2"></i> Mulai Cari Kos
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>