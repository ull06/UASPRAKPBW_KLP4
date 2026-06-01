<?php $__env->startSection('title', $kos->nama_kos); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .main-img { height: 360px; object-fit: cover; border-radius: 12px; width: 100%; }
    .gallery-img { width:100%; height:90px; object-fit:cover; border-radius:8px; cursor:pointer; transition:opacity .2s; }
    .gallery-img:hover { opacity:.8; }
    .star-input { display:flex; gap:6px; flex-direction:row-reverse; justify-content:flex-end; }
    .star-input input { display:none; }
    .star-input label { font-size:2rem; color:#ccc; cursor:pointer; transition:color .2s; }
    .star-input input:checked ~ label,
    .star-input label:hover,
    .star-input label:hover ~ label { color:#f39c12; }
    .img-placeholder-main { height:360px; background:linear-gradient(135deg,#dfe6e9,#b2bec3); display:flex; align-items:center; justify-content:center; color:#636e72; font-size:4rem; border-radius:12px; }
    .badge-putra { background-color:#2980b9; }
    .badge-putri { background-color:#e91e8c; }
    .badge-campur { background-color:#27ae60; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-3">
    <a href="<?php echo e(route('pencari.kos.index')); ?>" class="btn btn-sm btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i>Kembali ke Daftar Kos
    </a>
</div>

<div class="row g-4">
    
    <div class="col-lg-7">
        <?php if($kos->photos->isNotEmpty()): ?>
            <img id="mainPhoto" src="<?php echo e(asset('storage/'.$kos->photos->first()->image_path)); ?>"
                 class="main-img mb-3 shadow-sm" alt="<?php echo e($kos->nama_kos); ?>">
        <?php else: ?>
            <div class="img-placeholder-main mb-3"><i class="fas fa-building"></i></div>
        <?php endif; ?>

        <?php if($kos->photos->count() > 1): ?>
        <div class="row g-2 mb-3">
            <?php $__currentLoopData = $kos->photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-3">
                <img src="<?php echo e(asset('storage/'.$foto->image_path)); ?>" class="gallery-img"
                     onclick="document.getElementById('mainPhoto').src=this.src">
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

        <?php if($kos->deskripsi): ?>
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <h6 class="fw-bold mb-2"><i class="fas fa-info-circle me-2 text-primary"></i>Deskripsi</h6>
                <p class="mb-0 text-muted"><?php echo e($kos->deskripsi); ?></p>
            </div>
        </div>
        <?php endif; ?>

        
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0"><i class="fas fa-star me-2 text-warning"></i>Ulasan (<?php echo e($kos->reviews->count()); ?>)</h6>
                    <?php if($avgRating): ?>
                        <span class="badge bg-warning text-dark">⭐ <?php echo e(number_format($avgRating,1)); ?> / 5</span>
                    <?php endif; ?>
                </div>

                <?php $__empty_1 = true; $__currentLoopData = $kos->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="border-bottom pb-3 mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <strong><?php echo e($review->user->name); ?></strong>
                        <small class="text-muted"><?php echo e($review->created_at->diffForHumans()); ?></small>
                    </div>
                    <div class="mb-1">
                        <?php for($i=1;$i<=5;$i++): ?>
                            <i class="fas fa-star" style="<?php echo e($i<=$review->rating?'color:#f39c12':'color:#ddd'); ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <p class="mb-0 text-muted"><?php echo e($review->komentar); ?></p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-muted fst-italic">Belum ada ulasan.</p>
                <?php endif; ?>

                
                <?php if(!$sudahReview): ?>
                <hr>
                <h6 class="fw-bold mb-3"><i class="fas fa-pen me-2"></i>Tulis Ulasan</h6>
                <form method="POST" action="<?php echo e(route('pencari.review.store',$kos)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Rating</label>
                        <div class="star-input">
                            <?php for($i=5;$i>=1;$i--): ?>
                            <input type="radio" id="star<?php echo e($i); ?>" name="rating" value="<?php echo e($i); ?>"
                                   <?php echo e(old('rating')==$i?'checked':''); ?>>
                            <label for="star<?php echo e($i); ?>">&#9733;</label>
                            <?php endfor; ?>
                        </div>
                        <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Komentar</label>
                        <textarea name="komentar" rows="3"
                                  class="form-control <?php $__errorArgs = ['komentar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  placeholder="Bagikan pengalamanmu..."><?php echo e(old('komentar')); ?></textarea>
                        <?php $__errorArgs = ['komentar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-1"></i>Kirim Ulasan
                    </button>
                </form>
                <?php else: ?>
                <hr>
                <div class="alert alert-info mb-0 py-2">
                    <i class="fas fa-check-circle me-2"></i>Kamu sudah memberikan ulasan untuk kos ini.
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm sticky-top" style="top:20px">
            <div class="card-body">
                <h4 class="fw-bold mb-1"><?php echo e($kos->nama_kos); ?></h4>
                <div class="mb-3">
                    <span class="badge
                        <?php if($kos->jenis_kos==='putra'): ?> badge-putra
                        <?php elseif($kos->jenis_kos==='putri'): ?> badge-putri
                        <?php else: ?> badge-campur <?php endif; ?> me-2">
                        Kos <?php echo e(ucfirst($kos->jenis_kos)); ?>

                    </span>
                    <span class="badge <?php echo e($kos->status==='tersedia'?'bg-success':'bg-danger'); ?>">
                        <?php echo e(ucfirst($kos->status)); ?>

                    </span>
                </div>
                <hr>
                <p class="mb-2"><i class="fas fa-map-marker-alt text-danger me-2"></i><?php echo e($kos->alamat); ?></p>
                <p class="mb-2"><i class="fas fa-user text-primary me-2"></i>Pemilik: <strong><?php echo e($kos->user->name); ?></strong></p>
                <?php if($avgRating): ?>
                <p class="mb-2"><i class="fas fa-star text-warning me-2"></i><?php echo e(number_format($avgRating,1)); ?> / 5 (<?php echo e($kos->reviews->count()); ?> ulasan)</p>
                <?php endif; ?>
                <hr>
                <div class="text-center mb-3">
                    <div style="font-size:1.8rem; font-weight:800; color:var(--biru)">
                        Rp <?php echo e(number_format($kos->harga,0,',','.')); ?>

                    </div>
                    <div class="text-muted small">per bulan</div>
                </div>

                
                <form method="POST"
                      action="<?php echo e($isFavorit ? route('pencari.favorit.remove',$kos) : route('pencari.favorit.add',$kos)); ?>"
                      class="mb-2">
                    <?php echo csrf_field(); ?>
                    <?php if($isFavorit): ?> <?php echo method_field('DELETE'); ?> <?php endif; ?>
                    <button type="submit" class="btn w-100 <?php echo e($isFavorit?'btn-danger':'btn-outline-danger'); ?>">
                        <i class="fas fa-heart me-2"></i>
                        <?php echo e($isFavorit ? 'Hapus dari Favorit' : 'Tambah ke Favorit'); ?>

                    </button>
                </form>

                <a href="<?php echo e(route('pencari.kos.index')); ?>" class="btn btn-outline-secondary w-100">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\UASPRAKPBW_KLP4-main\resources\views/pencari/show.blade.php ENDPATH**/ ?>