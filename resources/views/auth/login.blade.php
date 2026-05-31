<x-guest-layout>
    <div class="w-100">
        <h4 class="text-center mb-4 fw-bold" style="color: var(--biru);">Sign In</h4>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            @if (session('status'))
                <div class="alert alert-success small mb-3">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mb-3">
                <label for="email" class="form-label text-secondary small fw-semibold">Email Address</label>
                <input id="email" class="form-control py-2 shadow-sm w-100" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" style="border-radius: 6px;" />
                @if ($errors->has('email'))
                    <span class="text-danger small mt-1 d-block">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="password" class="form-label text-secondary small fw-semibold">Password</label>
                <input id="password" class="form-control py-2 shadow-sm w-100" type="password" name="password" required autocomplete="current-password" style="border-radius: 6px;" />
                @if ($errors->has('password'))
                    <span class="text-danger small mt-1 d-block">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-check mb-4 text-start">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label text-muted small">Ingat saya di perangkat ini</label>
            </div>

            <div class="d-grid gap-2 mb-4">
                <button type="submit" class="btn btn-primary-custom py-2 shadow-sm w-100" style="border-radius: 6px;">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk Sekarang
                </button>
            </div>

            <hr class="text-muted opacity-25">

            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2 mt-3">
                @if (Route::has('password.request'))
                    <a class="small text-muted text-decoration-none" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
                
                <span class="small text-muted">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-custom-link">Register dulu</a>
                </span>
            </div>
        </form>
    </div>
</x-guest-layout>