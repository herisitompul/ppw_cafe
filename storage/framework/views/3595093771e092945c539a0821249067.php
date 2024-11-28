<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('kategori.update', $kategori->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="form-group">
        <label for="name">Nama:</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo e($kategori->nama); ?>" required>
    </div>
    <div class="form-group">
        <label for="gambar">Gambar</label>
        <input type="file" class="form-control" id="gambar" name="gambar">
        <?php if($kategori->gambar): ?>
            <img src="<?php echo e(asset('kategoris/' . $kategori->gambar)); ?>" alt="<?php echo e($kategori->nama); ?>" width="100">
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\ppw_cafe\resources\views/kategori/edit.blade.php ENDPATH**/ ?>