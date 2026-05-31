<x-guest-layout>
    <div class="w-100">
        <h4 class="text-center mb-4 fw-bold" style="color: var(--biru);">Buat Akun Baru</h4>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label text-secondary small fw-semibold">Nama Lengkap</label>
                <input id="name" class="form-control py-2 shadow-sm w-100" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" style="border-radius: 6px;" />
                @if ($errors->has('name'))
                    <span class="text-danger small mt-1 d-block">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="email" class="form-label text-secondary small fw-semibold">Alamat Email</label>
                <input id="email" class="form-control py-2 shadow-sm w-100" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" style="border-radius: 6px;" />
                @if ($errors->has('email'))
                    <span class="text-danger small mt-1 d-block">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="role" class="form-label text-secondary small fw-semibold">Daftar Sebagai</label>
                <select id="role" name="role" class="form-select py-2 shadow-sm w-100" style="border-radius: 6px; cursor: pointer;" required>
                    <option value="pencari" {{ old('role') == 'pencari' ? 'selected' : '' }}>Pencari Kos</option>
                    <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner (Pemilik Kos)</option>
                </select>
                @if ($errors->has('role'))
                    <span class="text-danger small mt-1 d-block">{{ $errors->first('role') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="password" class="form-label text-secondary small fw-semibold">Password</label>
                <input id="password" class="form-control py-2 shadow-sm w-100" type="password" name="password" required autocomplete="new-password" style="border-radius: 6px;" />
                @if ($errors->has('password'))
                    <span class="text-danger small mt-1 d-block">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label text-secondary small fw-semibold">Konfirmasi Password</label>
                <input id="password_confirmation" class="form-control py-2 shadow-sm w-100" type="password" name="password_confirmation" required autocomplete="new-password" style="border-radius: 6px;" />
                @if ($errors->has('password_confirmation'))
                    <span class="text-danger small mt-1 d-block">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>

            <div class="d-grid gap-2 mb-4">
                <button type="submit" class="btn btn-primary-custom py-2 shadow-sm w-100" style="border-radius: 6px;">
                    <i class="fas fa-user-plus me-2"></i>Daftar Akun
                </button>
            </div>

            <hr class="text-muted opacity-25">

            <div class="text-center mt-3">
                <span class="small text-muted">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-custom-link">Login di sini</a>
                </span>
            </div>
        </form>
    </div>
</x-guest-layout>