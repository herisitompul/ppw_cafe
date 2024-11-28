<?php $__env->startSection('content'); ?>
<p><strong>ID:</strong> <?php echo e($kategori->id); ?></p>
    <p><strong>Name:</strong> <?php echo e($kategori->nama); ?></p>
    <h3>Produk in this kategori</h3>
    <?php if($produk->isEmpty()): ?>

        <p>No produk found for this kategori.</p>
    <?php else: ?>
        <ul>
            <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a href="<?php echo e(route('produk.show', $produk->id)); ?>"><h3><?php echo e($produk->judul); ?></h3></a>
                    <p><?php echo e($produk->deskripsi); ?></p>
                    <p>Kategori: <?php echo e($produk->kategori->nama); ?></p>
                    <img src="<?php echo e(asset('gambar/' . $produk->gambar)); ?>" alt="<?php echo e($produk->judul); ?>" width="200"> <br> <br>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>

    <a href="<?php echo e(route('kategori.index')); ?>" class="btn btn-secondary">Back</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\ppw_cafe\resources\views/kategori/show.blade.php ENDPATH**/ ?>