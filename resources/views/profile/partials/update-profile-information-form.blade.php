<section>
    <header>
        <h5 class="fw-bold mb-1" style="color: var(--biru);">
            {{ __('Profile Information') }}
        </h5>
        <p class="text-muted mb-0">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="small mt-2">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="btn btn-link btn-sm p-0 align-baseline">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 small text-success fw-semibold">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label fw-semibold">{{ __('Nomor WhatsApp') }}</label>
            <input id="phone" name="phone" type="text" class="form-control" value="{{ old('phone', $user->phone) }}" autocomplete="tel" placeholder="Contoh: 081234567890">
            @error('phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn text-white px-4 profile-btn-save">
                <i class="fas fa-save me-1"></i>{{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <span class="badge text-bg-success py-2 px-3">
                    <i class="fas fa-check-circle me-1"></i>{{ __('Saved.') }}
                </span>
            @endif
        </div>
    </form>
</section>
