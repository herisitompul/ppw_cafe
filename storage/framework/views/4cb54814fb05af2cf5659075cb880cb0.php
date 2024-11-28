<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h3>Daftar Pesanan</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama User</th>
                <th>Produk</th>
                <th>Kuantitas</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Tanggal Pesanan</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($order->user->name); ?></td>
                <td><?php echo e($order->produk->judul); ?></td>
                <td><?php echo e($order->quantity); ?></td>
                <td>Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></td>
                <td><?php echo e(ucfirst($order->status)); ?></td>
                <td><?php echo e($order->created_at->format('d-m-Y H:i')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\ppw_cafe\resources\views/Admin/orders.blade.php ENDPATH**/ ?>