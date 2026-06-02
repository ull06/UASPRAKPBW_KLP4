<section class="space-y-6">
    <header>
        <h5 class="fw-bold mb-1" style="color: var(--merah);">
            {{ __('Delete Account') }}
        </h5>
        <p class="text-muted mb-3">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <div class="alert alert-warning border-0">
        <i class="fas fa-triangle-exclamation me-2"></i>
        Aksi ini permanen dan tidak bisa dibatalkan.
    </div>

    <form method="post" action="{{ route('profile.destroy') }}" class="row g-3 align-items-end"
          onsubmit="return confirm('Yakin ingin menghapus akun ini secara permanen?')">
        @csrf
        @method('delete')

        <div class="col-md-8">
            <label for="delete_password" class="form-label fw-semibold">{{ __('Password Confirmation') }}</label>
            <input
                id="delete_password"
                name="password"
                type="password"
                class="form-control"
                placeholder="{{ __('Enter your password') }}"
                required
            />
            @if($errors->userDeletion->has('password'))
                <div class="text-danger small mt-1">{{ $errors->userDeletion->first('password') }}</div>
            @endif
        </div>

        <div class="col-md-4">
            <button type="submit" class="btn text-white w-100 profile-btn-delete">
                <i class="fas fa-trash me-1"></i>{{ __('Delete Account') }}
            </button>
        </div>
    </form>
</section>
