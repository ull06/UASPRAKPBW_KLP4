<?php $__env->startSection('title', 'Dashboard Pencari Kos'); ?>

<?php $__env->startSection('content'); ?>
    <h4 class="mb-4" style="color: var(--biru); font-weight: 700;">
        <i class="fas fa-home me-2"></i>Dashboard Pencari Kos
    </h4>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Kos Favorit Saya</h6>
                        <h2 style="color: var(--biru);"><?php echo e($totalFavorit); ?></h2>
                        <a href="<?php echo e(route('pencari.favorit')); ?>" class="btn btn-sm btn-outline-danger mt-1">
                            <i class="fas fa-heart me-1"></i>Lihat Favorit
                        </a>
                    </div>
                    <i class="fas fa-heart fa-3x" style="color: var(--merah); opacity:.2;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3 border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Review Saya</h6>
                        <h2 style="color: var(--biru);"><?php echo e($totalReview); ?></h2>
                        <a href="<?php echo e(route('pencari.kos.index')); ?>" class="btn btn-sm btn-outline-primary mt-1">
                            <i class="fas fa-search me-1"></i>Cari Kos
                        </a>
                    </div>
                    <i class="fas fa-star fa-3x" style="color: var(--merah); opacity:.2;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mt-2">
        <div class="card-body">
            <h5 style="color: var(--biru);">Selamat datang, <?php echo e(Auth::user()->name); ?>! 👋</h5>
            <p class="text-muted mb-3">Temukan kos impianmu di sini.</p>
            <a href="<?php echo e(route('pencari.kos.index')); ?>" class="btn btn-primary">
                <i class="fas fa-search me-2"></i>Mulai Cari Kos
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\UASPRAKPBW_KLP4-main\resources\views/pencari/dashboard.blade.php ENDPATH**/ ?>