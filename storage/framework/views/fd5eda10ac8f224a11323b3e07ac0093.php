<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Keranjang Anda</h1>
    <?php if($carts->isEmpty()): ?>
        <p>Keranjang Anda kosong.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Kuantitas</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($cart->product->judul); ?></td>
                    <td>Rp <?php echo e(number_format($cart->product->harga, 0, ',', '.')); ?></td>
                    <td>
                        <form method="POST" action="<?php echo e(route('cart.update', $cart->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <input type="number" name="quantity" value="<?php echo e($cart->quantity); ?>" min="1" class="form-control">
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
                        </form>
                    </td>
                    <td>Rp <?php echo e(number_format($cart->product->harga * $cart->quantity, 0, ',', '.')); ?></td>
                    <td>
                        <form method="POST" action="<?php echo e(route('cart.destroy', $cart->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <p><strong>Total Harga: Rp <?php echo e(number_format($carts->sum(fn($c) => $c->product->harga * $c->quantity), 0, ',', '.')); ?></strong></p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\ppw_cafe\resources\views/cart/index.blade.php ENDPATH**/ ?>