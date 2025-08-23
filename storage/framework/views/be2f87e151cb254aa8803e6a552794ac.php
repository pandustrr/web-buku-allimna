<?php $__env->startSection('title', 'Keranjang Belanja'); ?>

<?php $__env->startSection('content'); ?>
    <?php if(auth()->guard()->check()): ?>
        <div class="min-h-screen bg-gray-50 py-6">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Keranjang Belanja</h1>
                    <a href="<?php echo e(route('home')); ?>"
                        class="inline-flex items-center px-4 py-2 bg-[#56DFCF] text-gray-800 rounded-md hover:bg-[#0ABAB5] transition duration-150 ease-in-out">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>

                <?php if($cart->items->isEmpty()): ?>
                    <div class="bg-white shadow-sm rounded-lg p-6 text-center">
                        <p class="text-gray-600 mb-4">Keranjang belanja Anda kosong</p>
                        <a href="<?php echo e(route('home')); ?>"
                            class="inline-flex items-center px-4 py-2 bg-[#0ABAB5] text-white rounded-md hover:bg-[#56DFCF]">
                            Lanjutkan Belanja
                        </a>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Daftar Produk -->
                        <div class="lg:col-span-2 space-y-4">
                            <?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                                    <div class="p-4 flex flex-col sm:flex-row">
                                        <div class="flex-shrink-0">
                                            <img src="<?php echo e($item->product->foto_url); ?>" alt="<?php echo e($item->product->judul); ?>"
                                                class="w-24 h-32 object-cover rounded-md border border-gray-200">
                                        </div>
                                        <div class="mt-4 sm:mt-0 sm:ml-6 flex-1">
                                            <div class="flex justify-between">
                                                <div>
                                                    <h3 class="text-lg font-medium text-gray-900"><?php echo e($item->product->judul); ?>

                                                    </h3>
                                                    <p class="text-sm text-gray-600">Oleh: <?php echo e($item->product->penulis); ?></p>
                                                    <p class="text-sm text-gray-600 mt-1">
                                                        Stok Tersedia: <?php echo e($item->product->stok); ?>

                                                    </p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-lg font-medium text-[#0ABAB5]">
                                                        Rp <?php echo e(number_format($item->product->harga, 0, ',', '.')); ?>

                                                    </p>
                                                </div>
                                            </div>

                                            <div class="mt-4 flex items-center justify-between">
                                                <form action="<?php echo e(route('cart.update', $item)); ?>" method="POST"
                                                    class="flex items-center space-x-2">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>

                                                    <label for="quantity-<?php echo e($item->id); ?>"
                                                        class="text-sm text-gray-600">Jumlah:</label>

                                                    <input type="number" id="quantity-<?php echo e($item->id); ?>" name="quantity"
                                                        min="1" max="<?php echo e($item->product->stok); ?>"
                                                        value="<?php echo e($item->quantity); ?>"
                                                        class="w-16 px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0ABAB5]"
                                                        onchange="validateCartQuantity(this, <?php echo e($item->id); ?>, <?php echo e($item->product->stok); ?>)">

                                                    <button type="submit"
                                                        class="px-3 py-2 rounded-md bg-[#0ABAB5] text-white hover:bg-[#56DFCF] transition duration-150 flex items-center">
                                                        <i class="fas fa-check text-sm"></i>
                                                    </button>
                                                </form>


                                                <form action="<?php echo e(route('cart.remove', $item)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>

                                            <div class="mt-2 flex justify-end">
                                                <p class="text-gray-900 font-medium">
                                                    Subtotal: Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?>

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <!-- Ringkasan Pesanan -->
                        <div class="lg:col-span-1">
                            <div class="bg-white shadow-sm rounded-lg sticky top-6 p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h3>

                                <div class="space-y-3">
                                    <?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600"><?php echo e($item->product->judul); ?>

                                                (x<?php echo e($item->quantity); ?>)
                                            </span>
                                            <span class="text-sm font-medium text-gray-900">
                                                Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?>

                                            </span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <hr class="my-3 border-gray-200">

                                    <div class="flex justify-between">
                                        <span class="text-base font-semibold text-gray-900">Total</span>
                                        <span class="text-lg font-bold text-[#0ABAB5]">
                                            Rp <?php echo e(number_format($cart->total, 0, ',', '.')); ?>

                                        </span>
                                    </div>
                                </div>

                                <!-- Form Pemesanan -->
                                <form id="orderForm" class="mt-6 space-y-4">
                                    <div>
                                        <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">
                                            Nama Lengkap <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="customer_name" name="customer_name" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#0ABAB5] focus:border-[#0ABAB5]">
                                    </div>

                                    <div>
                                        <label for="pgtpq" class="block text-sm font-medium text-gray-700 mb-1">
                                            PGTPQ <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="pgtpq" name="pgtpq" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#0ABAB5] focus:border-[#0ABAB5]">
                                    </div>

                                    <div>
                                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                                            Alamat Pengiriman <span class="text-red-500">*</span>
                                        </label>
                                        <textarea id="address" name="address" rows="3" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#0ABAB5] focus:border-[#0ABAB5]"
                                            placeholder="Masukkan alamat lengkap"></textarea>
                                    </div>

                                    <div>
                                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                                            Catatan (Opsional)
                                        </label>
                                        <textarea id="notes" name="notes" rows="2"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[#0ABAB5] focus:border-[#0ABAB5]"
                                            placeholder="Catatan khusus untuk penjual"></textarea>
                                    </div>

                                    <div class="flex space-x-3">
                                        <a href="<?php echo e(route('home')); ?>"
                                            class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition duration-150 ease-in-out">
                                            <i class="fas fa-arrow-left mr-2"></i>
                                            Kembali
                                        </a>
                                        <button type="button" id="whatsappBtn"
                                            class="flex-1 bg-[#25D366] hover:bg-[#128C7E] text-white font-medium py-2 px-4 rounded-md shadow-sm flex items-center justify-center transition duration-150 ease-in-out">
                                            <i class="fab fa-whatsapp mr-2 text-lg"></i>
                                            Pesan via WhatsApp
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <script>
            function validateCartQuantity(input, itemId, maxStock) {
                let quantity = parseInt(input.value);

                if (quantity < 1) {
                    input.value = 1;
                    quantity = 1;
                }

                if (quantity > maxStock) {
                    input.value = maxStock;
                    quantity = maxStock;
                    alert('Jumlah melebihi stok yang tersedia. Stok maksimum: ' + maxStock);
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const whatsappBtn = document.getElementById('whatsappBtn');

                whatsappBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Validasi form
                    const name = document.getElementById('customer_name').value;
                    const pgtpq = document.getElementById('pgtpq').value;
                    const address = document.getElementById('address').value;

                    if (!name || !pgtpq || !address) {
                        alert('Harap lengkapi semua field yang wajib diisi!');
                        return;
                    }

                    // Kirim request ke server untuk konfirmasi pesanan
                    fetch('<?php echo e(route('cart.confirm')); ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                            },
                            body: JSON.stringify({
                                customer_name: name,
                                pgtpq: pgtpq,
                                address: address,
                                notes: document.getElementById('notes').value || '-'
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Buat pesan WhatsApp
                                let message = `*PEMESANAN BUKU*\n\n`;
                                message += `*DATA PEMESAN*\n`;
                                message += `Nama Lengkap : ${name}\n`;
                                message += `PGTPQ        : ${pgtpq}\n`;
                                message += `Alamat       : ${address}\n`;
                                message +=
                                    `Catatan      : ${document.getElementById('notes').value || '-'}\n\n`;
                                message += `*DETAIL PESANAN*\n`;

                                <?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    message += `--------------------------------\n`;
                                    message += `*Judul Buku*  : <?php echo $item->product->judul; ?>\n`;
                                    message += `Harga Satuan  : Rp <?php echo number_format($item->product->harga, 0, ',', '.'); ?>\n`;
                                    message += `Jumlah        : <?php echo $item->quantity; ?> buku\n`;
                                    message += `Subtotal      : Rp <?php echo number_format($item->subtotal, 0, ',', '.'); ?>\n`;
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                message += `\n*TOTAL PEMBAYARAN*: Rp <?php echo number_format($cart->total, 0, ',', '.'); ?>\n\n`;
                                message +=
                                    `Mohon konfirmasi ketersediaan buku dan informasi total pembayaran termasuk ongkos kirim.\n`;
                                message += `Terima kasih 🙏`;

                                // Buka WhatsApp
                                const encodedMessage = encodeURIComponent(message);
                                window.open(`https://wa.me/62895352729214?text=${encodedMessage}`,
                                    '_blank');

                                // Redirect ke halaman terima kasih
                                window.location.href = '<?php echo e(route('cart.thankyou')); ?>';
                            } else {
                                alert('Gagal memproses pesanan: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat memproses pesanan');
                        });
                });
            });
        </script>
    <?php else: ?>
        <div class="min-h-screen bg-gray-50 flex items-center justify-center">
            <div class="bg-white p-8 rounded-lg shadow-md text-center max-w-md">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Anda perlu login</h2>
                <p class="text-gray-600 mb-6">Silakan login terlebih dahulu untuk mengakses keranjang belanja</p>
                <a href="<?php echo e(route('login')); ?>"
                    class="inline-block bg-[#0ABAB5] text-white px-6 py-2 rounded-md hover:bg-[#56DFCF] transition">
                    Login Sekarang
                </a>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Allima-main\resources\views/keranjang.blade.php ENDPATH**/ ?>