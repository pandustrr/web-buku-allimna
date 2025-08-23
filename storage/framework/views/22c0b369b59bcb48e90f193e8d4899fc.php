<?php $__env->startSection('title', 'Detail Pesanan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-white rounded shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold">Detail Pesanan #<?php echo e($order->order_number); ?></h2>
            <div class="flex items-center space-x-2">
                <span
                    class="px-3 py-1 rounded-full text-sm font-medium
                <?php if($order->status === 'completed'): ?> bg-green-100 text-green-800
                <?php elseif($order->status === 'cancelled'): ?> bg-red-100 text-red-800
                <?php else: ?> bg-yellow-100 text-yellow-800 <?php endif; ?>">
                    <?php echo e(ucfirst($order->status)); ?>

                </span>
                <form action="<?php echo e(route('admin.sales.update-status', $order)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <select name="status" onchange="this.form.submit()"
                        class="border rounded px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="diproses" <?php echo e($order->status === 'diproses' ? 'selected' : ''); ?>>Diproses</option>
                        <option value="selesai" <?php echo e($order->status === 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                        <option value="dibatalkan" <?php echo e($order->status === 'dibatalkan' ? 'selected' : ''); ?>>Dibatalkan
                        </option>
                    </select>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-medium mb-4">Informasi Pelanggan</h3>
                <div class="space-y-2">
                    <p><span class="font-medium">Nama:</span> <?php echo e($order->customer_name); ?></p>
                    <p><span class="font-medium">PGTPQ:</span> <?php echo e($order->pgtpq); ?></p>
                    <p><span class="font-medium">Alamat:</span> <?php echo e($order->address); ?></p>
                    <p><span class="font-medium">Catatan:</span> <?php echo e($order->notes ?? '-'); ?></p>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-medium mb-4">Ringkasan Pesanan</h3>
                <div class="space-y-2">
                    <p><span class="font-medium">Tanggal:</span> <?php echo e($order->created_at->format('d M Y H:i')); ?></p>
                    <p><span class="font-medium">No. Pesanan:</span> <?php echo e($order->order_number); ?></p>
                    <p><span class="font-medium">Total:</span> Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?>

                    </p>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-medium mb-4">Daftar Produk</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left">Produk</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left">Harga</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left">Jumlah</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200"><?php echo e($item->product->judul); ?></td>
                                <td class="py-2 px-4 border-b border-gray-200">Rp
                                    <?php echo e(number_format($item->price, 0, ',', '.')); ?></td>
                                <td class="py-2 px-4 border-b border-gray-200"><?php echo e($item->quantity); ?></td>
                                <td class="py-2 px-4 border-b border-gray-200">Rp
                                    <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex justify-end">
            <a href="<?php echo e(route('admin.sales.index')); ?>"
                class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                Kembali ke Daftar
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Allima-main\resources\views/admin/sales/show.blade.php ENDPATH**/ ?>