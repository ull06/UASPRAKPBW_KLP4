<?php $__env->startSection('title', 'Favorit Saya'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .card-kos { border:none; border-radius:12px; overflow:hidden; transition:transform .2s,box-shadow .2s; }
    .card-kos:hover { transform:translateY(-4px); box-shadow:0 8px 24px rgba(44,62,107,.15); }
    .card-kos .card-img-top { height:180px; object-fit:cover; }
    .img-placeholder { height:180px; background:linear-gradient(135deg,#dfe6e9,#b2bec3); display:flex; align-items:center; justify-content:center; color:#636e72; font-size:2.5rem; }
    .price-tag { color:var(--biru); font-weight:700; font-size:1.1rem; }
    .badge-putra { background-color:#2980b9; }
    .badge-putri { background-color:#e91e8c; }
    .badge-campur { background-color:#27ae60; }
    .favorit-header { background:linear-gradient(135deg,var(--merah),#922b21); color:white; padding:24px; border-radius:12px; margin-bottom:24px; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="favorit-header">
    <h4 class="fw-bold mb-1"><i class="fas fa-heart me-2"></i>Kos Favorit Saya</h4>
    <p class="mb-0 opacity-75"><?php echo e($favoritKos->count()); ?> kos tersimpan</p>
</div>

<?php if($favoritKos->isEmpty()): ?>
    <div class="text-center py-5">
        <i class="fas fa-heart-broken fa-4x text-muted mb-3"></i>
        <h5 class="text-muted">Belum ada kos favorit</h5>
        <a href="<?php echo e(route('pencari.kos.index')); ?>" class="btn btn-primary mt-2">
            <i class="fas fa-search me-2"></i>Cari Kos
        </a>
    </div>
<?php else: ?>
    <div class="row g-4">
        <?php $__currentLoopData = $favoritKos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6 col-lg-4">
            <div class="card card-kos shadow-sm h-100">
                <?php if($kos->photos->isNotEmpty()): ?>
                    <img src="<?php echo e(asset('storage/'.$kos->photos->first()->image_path)); ?>"
                         class="card-img-top" alt="<?php echo e($kos->nama_kos); ?>"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                    <div class="img-placeholder" style="display:none"><i class="fas fa-building"></i></div>
                <?php else: ?>
                    <div class="img-placeholder"><i class="fas fa-building"></i></div>
                <?php endif; ?>

                <div class="card-body d-flex flex-column">
                    <h6 class="fw-bold"><?php echo e($kos->nama_kos); ?></h6>
                    <div class="mb-2">
                        <span class="badge
                            <?php if($kos->jenis_kos==='putra'): ?> badge-putra
                            <?php elseif($kos->jenis_kos==='putri'): ?> badge-putri
                            <?php else: ?> badge-campur <?php endif; ?> me-1" style="font-size:.7rem">
                            <?php echo e(ucfirst($kos->jenis_kos)); ?>

                        </span>
                        <span class="badge <?php echo e($kos->status==='tersedia'?'bg-success':'bg-danger'); ?>" style="font-size:.7rem">
                            <?php echo e(ucfirst($kos->status)); ?>

                        </span>
                    </div>
                    <p class="text-muted small mb-2">
                        <i class="fas fa-map-marker-alt me-1"></i><?php echo e(Str::limit($kos->alamat,50)); ?>

                    </p>
                    <?php if($kos->reviews->count() > 0): ?>
                    <div class="mb-2">
                        <?php for($i=1;$i<=5;$i++): ?>
                            <i class="fas fa-star" style="<?php echo e($i<=round($kos->reviews->avg('rating'))?'color:#f39c12':'color:#ddd'); ?>"></i>
                        <?php endfor; ?>
                        <small class="text-muted">(<?php echo e($kos->reviews->count()); ?>)</small>
                    </div>
                    <?php endif; ?>
                    <div class="mt-auto">
                        <div class="price-tag mb-2">Rp <?php echo e(number_format($kos->harga,0,',','.')); ?><small class="text-muted fw-normal">/bulan</small></div>
                        <div class="d-flex gap-2">
                            <a href="<?php echo e(route('pencari.kos.show',$kos)); ?>" class="btn btn-outline-primary btn-sm flex-fill">
                                <i class="fas fa-eye me-1"></i>Detail
                            </a>
                            <form method="POST" action="<?php echo e(route('pencari.favorit.remove',$kos)); ?>">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('Hapus dari favorit?')">
                                    <i class="fas fa-heart-broken"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\UASPRAKPBW_KLP4-main\resources\views/pencari/favorit.blade.php ENDPATH**/ ?>