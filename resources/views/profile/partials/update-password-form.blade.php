<section>
    <header>
        <h5 class="fw-bold mb-1" style="color: var(--biru);">
            {{ __('Update Password') }}
        </h5>
        <p class="text-muted mb-0">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label fw-semibold">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
            @if($errors->updatePassword->has('current_password'))
                <div class="text-danger small mt-1">{{ $errors->updatePassword->first('current_password') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label fw-semibold">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password">
            @if($errors->updatePassword->has('password'))
                <div class="text-danger small mt-1">{{ $errors->updatePassword->first('password') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label fw-semibold">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
            @if($errors->updatePassword->has('password_confirmation'))
                <div class="text-danger small mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn text-white px-4 profile-btn-save">
                <i class="fas fa-key me-1"></i>{{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <span class="badge text-bg-success py-2 px-3">
                    <i class="fas fa-check-circle me-1"></i>{{ __('Saved.') }}
                </span>
            @endif
        </div>
    </form>
</section>
