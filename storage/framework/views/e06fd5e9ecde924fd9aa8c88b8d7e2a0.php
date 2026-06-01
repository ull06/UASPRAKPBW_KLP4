<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="w-100">
        <h4 class="text-center mb-4 fw-bold" style="color: var(--biru);">Sign In</h4>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            <?php if(session('status')): ?>
                <div class="alert alert-success small mb-3">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="email" class="form-label text-secondary small fw-semibold">Email Address</label>
                <input id="email" class="form-control py-2 shadow-sm w-100" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus autocomplete="username" style="border-radius: 6px;" />
                <?php if($errors->has('email')): ?>
                    <span class="text-danger small mt-1 d-block"><?php echo e($errors->first('email')); ?></span>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label text-secondary small fw-semibold">Password</label>
                <input id="password" class="form-control py-2 shadow-sm w-100" type="password" name="password" required autocomplete="current-password" style="border-radius: 6px;" />
                <?php if($errors->has('password')): ?>
                    <span class="text-danger small mt-1 d-block"><?php echo e($errors->first('password')); ?></span>
                <?php endif; ?>
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
                <?php if(Route::has('password.request')): ?>
                    <a class="small text-muted text-decoration-none" href="<?php echo e(route('password.request')); ?>">
                        Lupa password?
                    </a>
                <?php endif; ?>
                
                <span class="small text-muted">
                    Belum punya akun? <a href="<?php echo e(route('register')); ?>" class="text-custom-link">Register dulu</a>
                </span>
            </div>
        </form>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?><?php /**PATH D:\laragon\www\UASPRAKPBW_KLP4-main\resources\views/auth/login.blade.php ENDPATH**/ ?>