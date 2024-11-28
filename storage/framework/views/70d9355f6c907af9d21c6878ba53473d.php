<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('produk.update', $produk->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="form-group">
        <label for="judul">Judul</label>
        <input type="text" class="form-control" id="judul" name="judul" value="<?php echo e($produk->judul); ?>" required>
    </div>
    <div class="form-group">
        <label for="kategori_id">Kategori:</label>
        <select class="form-control" id="kategori_id" name="kategori_id" required>
            <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategoriItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($kategoriItem->id); ?>"><?php echo e($kategoriItem->nama); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="form-group">
        <label for="stok">Stok</label>
        <input type="number" class="form-control" id="stok" name="stok" value="<?php echo e($produk->stok); ?>" required>
    </div>
    <div class="form-group">
        <label for="harga">Harga</label>
        <input type="number" class="form-control" id="harga" name="harga" value="<?php echo e($produk->harga); ?>" required>
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?php echo e($produk->deskripsi); ?></textarea>
    </div>
    <div class="form-group">
        <label for="gambar">Gambar:</label>
        <input type="file" class="form-control" id="gambar" name="gambar">
        <img src="<?php echo e(asset('gambar/' . $produk->gambar)); ?>" alt="<?php echo e($produk->gambar); ?>" width="100">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\del_cafe\resources\views/produk/edit.blade.php ENDPATH**/ ?>