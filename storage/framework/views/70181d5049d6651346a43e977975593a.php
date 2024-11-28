<?php $__env->startSection('content'); ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($kategori->id); ?></td>
                    <td><?php echo e($kategori->nama); ?></td>
                    <td>
                        <?php if($kategori->gambar): ?>
                            <img src="<?php echo e(asset('kategoris/' . $kategori->gambar)); ?>" alt="<?php echo e($kategori->nama); ?>" width="50">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('kategori.show', $kategori->id)); ?>" class="btn btn-info">Detail</a>
                        <a href="<?php echo e(route('kategori.edit', $kategori->id)); ?>" class="btn btn-warning">Edit</a>
                        <form action="<?php echo e(route('kategori.destroy', $kategori->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\ppw_cafe\resources\views/kategori/index.blade.php ENDPATH**/ ?>