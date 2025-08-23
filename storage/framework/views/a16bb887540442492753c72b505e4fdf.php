<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Admin</h1>

    <!-- Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow rounded-lg p-5 flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                <i class="fas fa-book text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Produk</p>
                <p class="text-2xl font-bold text-gray-800"><?php echo e($totalProducts); ?></p>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-5 flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                <i class="fas fa-boxes text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Stok</p>
                <p class="text-2xl font-bold text-gray-800"><?php echo e($totalStock); ?></p>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-5 flex items-center">
            <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                <i class="fas fa-exclamation-triangle text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Produk Habis</p>
                <p class="text-2xl font-bold text-gray-800"><?php echo e($outOfStockProducts); ?></p>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-5 flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                <i class="fas fa-money-bill-wave text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Nilai Penjualan</p>
                <p class="text-2xl font-bold text-gray-800">Rp <?php echo e(number_format($inventoryValue, 0, ',', '.')); ?></p>
            </div>
        </div>
    </div>

    <!-- Produk Terbaru -->
    <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Produk Terbaru</h2>
        </div>
        <div class="divide-y divide-gray-200">
            <?php $__empty_1 = true; $__currentLoopData = $recentProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="p-4 sm:p-6 hover:bg-gray-50 flex flex-col sm:flex-row items-start sm:items-center">
                <img src="<?php echo e($product->foto_url); ?>" alt="<?php echo e($product->judul); ?>"
                     class="h-20 w-16 object-cover rounded mb-3 sm:mb-0 sm:mr-4 flex-shrink-0">
                <div class="flex-1 w-full">
                    <h3 class="text-lg font-medium text-gray-800"><?php echo e($product->judul); ?></h3>
                    <p class="text-sm text-gray-600">Oleh: <?php echo e($product->penulis); ?></p>
                    <div class="mt-2 flex items-center justify-between">
                        <span class="text-sm font-medium text-blue-600">Rp <?php echo e(number_format($product->harga, 0, ',', '.')); ?></span>
                        <span class="text-sm <?php echo e($product->stok > 0 ? 'text-green-600' : 'text-red-600'); ?>">
                            Stok: <?php echo e($product->stok); ?>

                        </span>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="p-6 text-center text-gray-500">Tidak ada produk terbaru.</div>
            <?php endif; ?>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 text-right">
            <a href="<?php echo e(route('admin.products.index')); ?>" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                Lihat Semua Produk →
            </a>
        </div>
    </div>

    <!-- Produk Stok Sedikit -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Produk dengan Stok Sedikit</h2>
        </div>
        <div class="divide-y divide-gray-200">
            <?php $__empty_1 = true; $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="p-4 sm:p-6 hover:bg-gray-50 flex flex-col sm:flex-row items-start sm:items-center">
                <img src="<?php echo e($product->foto_url); ?>" alt="<?php echo e($product->judul); ?>"
                     class="h-20 w-16 object-cover rounded mb-3 sm:mb-0 sm:mr-4 flex-shrink-0">
                <div class="flex-1 w-full">
                    <h3 class="text-lg font-medium text-gray-800"><?php echo e($product->judul); ?></h3>
                    <p class="text-sm text-gray-600">Oleh: <?php echo e($product->penulis); ?></p>
                    <div class="mt-2 flex items-center justify-between">
                        <span class="text-sm font-medium text-blue-600">Rp <?php echo e(number_format($product->harga, 0, ',', '.')); ?></span>
                        <span class="text-sm text-red-600">
                            Stok: <?php echo e($product->stok); ?>

                        </span>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="p-6 text-center text-gray-500">Tidak ada produk dengan stok sedikit.</div>
            <?php endif; ?>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 text-right">
            <a href="<?php echo e(route('admin.products.index')); ?>" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                Lihat Semua Produk →
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Pandu-Projek\web-buku\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>