<?php $__env->startSection('content'); ?>
<div class="container text-center mt-5">
    <h3>Pesanan Anda Berhasil!</h3>
    <p>Pesanan Anda sedang diproses.</p>
    <a href="<?php echo e(route('user.dashboard')); ?>" class="btn btn-primary">Kembali ke Beranda</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\ppw_cafe\resources\views/order/success.blade.php ENDPATH**/ ?>