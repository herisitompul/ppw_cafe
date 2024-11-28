<?php $__env->startSection('content'); ?>

<form action="<?php echo e(route('kategori.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <h3>Tambah Kategori</h3>
    <div class="form-group">
        <label for="title">Nama Kategori</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <div class="form-group">
        <label for="gambar">Gambar</label>
        <input type="file" class="form-control" id="gambar" name="gambar">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\ppw_cafe\resources\views/kategori/create.blade.php ENDPATH**/ ?>