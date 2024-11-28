<?php $__env->startSection('content'); ?>
<div class="container text-center mt-5">
    <h3>Silakan Lakukan Pembayaran</h3>
    <p>Scan QRIS berikut untuk menyelesaikan pembayaran:</p>
    <img src="<?php echo e(asset('images/qris-sample.png')); ?>" alt="QRIS" style="width: 300px;">

    <form action="<?php echo e(route('order.success')); ?>" method="GET">
        <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>">
        <button type="submit" class="btn btn-success mt-3">Konfirmasi Pembayaran</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\ppw_cafe\resources\views/order/payment.blade.php ENDPATH**/ ?>