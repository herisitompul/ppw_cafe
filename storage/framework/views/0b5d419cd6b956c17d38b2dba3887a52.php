<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('produk.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <h3>Tambah Produk</h3>
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
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
                <input type="number" class="form-control" id="stok" name="stok" required>
            </div>
            <div class="form-group">
                <label for="price">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="form-group">
                <label for="details">Deskripsi</label>
                <textarea class="form-control" id="details" name="deskripsi" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Gambar</label>
                <input type="file" class="form-control-file" id="gambar" name="gambar" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\ppw_cafe\resources\views/produk/create.blade.php ENDPATH**/ ?>