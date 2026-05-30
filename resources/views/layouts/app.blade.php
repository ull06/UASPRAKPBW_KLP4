<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KosFinder - @yield('title')</title>
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
        }
        .navbar {
            background-color: var(--biru) !important;
        }
        .navbar-brand span.kos {
            color: white;
            font-weight: 800;
            font-size: 1.5rem;
        }
        .navbar-brand span.finder {
            color: var(--merah);
            font-weight: 800;
            font-size: 1.5rem;
        }
        .navbar-text {
            color: white !important;
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <span class="kos">Kos</span><span class="finder">Finder</span>
            </a>
            <div class="ms-auto">
                <span class="navbar-text">
                    <i class="fas fa-user me-1"></i> {{ Auth::user()->name ?? 'Guest' }}
                </span>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>