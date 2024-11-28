<?php $__env->startSection('content'); ?>
<?php if($message = Session::get('success')): ?>
	  <div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		  <strong><?php echo e($message); ?></strong>
	  </div>
	<?php endif; ?>

	<?php if($message = Session::get('error')): ?>
	  <div class="alert alert-danger alert-block">
	    <button type="button" class="close" data-dismiss="alert">×</button>
		<strong><?php echo e($message); ?></strong>
	  </div>
	<?php endif; ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col" style="width: 10px">No</th>
                <th scope="col">Judul</th>
                <th scope="col">Kategori</th>
                <th scope="col">Stok</th>
                <th scope="col">Harga</th>
                <th scope="col"style="width: 500px">Deskripsi</th>
                <th scope="col" style="width: 30px">Gambar</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index + 1); ?></td>
                <td><?php echo e($produk->judul); ?></td>
                <td><?php echo e($produk->kategori->nama); ?></td>
                <td><?php echo e($produk->stok); ?></td>
                
                <td><?php echo e($produk->harga); ?></td>
                <td><?php echo e($produk->deskripsi); ?></td>
                <td><img src="<?php echo e(asset('gambar/' . $produk->gambar)); ?>" alt="" style="width: 150px"></td>
                <td>
                <a href="<?php echo e(route('produk.edit', $produk->id)); ?>" class="btn btn-warning">Edit</a>
                    <form action="<?php echo e(route('produk.destroy', $produk->id)); ?>" method="POST" style="display: inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\del_cafe\resources\views/produk/index.blade.php ENDPATH**/ ?>