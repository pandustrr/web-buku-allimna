<?php $__env->startSection('title', $product->judul); ?>

<?php $__env->startSection('content'); ?>
    <div class="min-h-screen bg-gray-50 py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Detail Produk</h1>
                <a href="<?php echo e(route('home')); ?>"
                    class="inline-flex items-center px-4 py-2 bg-[#56DFCF] text-gray-800 rounded-md hover:bg-[#0ABAB5] transition duration-150 ease-in-out">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Foto Produk -->
                        <div>
                            <img src="<?php echo e($product->foto_url); ?>" alt="<?php echo e($product->judul); ?>"
                                class="w-full h-auto rounded-lg shadow-md border border-gray-200">
                        </div>

                        <!-- Detail Produk -->
                        <div class="space-y-4">
                            <h1 class="text-2xl font-bold text-gray-900"><?php echo e($product->judul); ?></h1>
                            <p class="text-gray-600">Oleh: <?php echo e($product->penulis); ?></p>

                            <div class="flex items-center">
                                <span class="text-2xl font-bold text-[#0ABAB5]">
                                    Rp <?php echo e(number_format($product->harga, 0, ',', '.')); ?>

                                </span>
                                <?php if($product->available_stock > 0): ?>
                                    <span
                                        class="ml-4 px-2 py-1 text-xs font-medium rounded-full bg-[#ADEED9] text-green-800">
                                        Stok Tersedia (<?php echo e($product->available_stock); ?>)
                                    </span>
                                <?php else: ?>
                                    <span class="ml-4 px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                        Stok Habis
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Form Tambah ke Keranjang -->
                            <?php if($product->available_stock > 0): ?>
                                <?php if(auth()->check()): ?>
                                    <form action="<?php echo e(route('cart.add', $product)); ?>" method="POST"
                                        class="mt-6 add-to-cart-form" data-product-id="<?php echo e($product->id); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="flex items-center space-x-4">
                                            <div class="w-24">
                                                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                                                <input type="number" id="quantity" name="quantity" min="1"
                                                       max="<?php echo e($product->available_stock); ?>" value="1"
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm quantity-input">
                                            </div>
                                            <button type="submit"
                                                    class="flex-1 bg-[#0ABAB5] hover:bg-[#56DFCF] text-white px-6 py-3 rounded-md font-medium transition duration-150 flex items-center justify-center add-to-cart-btn mt-6"
                                                    data-available-stock="<?php echo e($product->available_stock); ?>">
                                                <i class="fas fa-cart-plus mr-2"></i>
                                                <span class="btn-text">Tambah ke Keranjang</span>
                                                <span class="btn-loading hidden">
                                                    <i class="fas fa-spinner fa-spin mr-2"></i>Menambahkan...
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                <?php else: ?>
                                    <div class="mt-6">
                                        <a href="<?php echo e(route('login')); ?>"
                                            class="flex-1 bg-[#0ABAB5] hover:bg-[#56DFCF] text-white px-6 py-3 rounded-md font-medium transition duration-150 flex items-center justify-center">
                                            <i class="fas fa-sign-in-alt mr-2"></i>
                                            Login untuk Membeli
                                        </a>
                                        <p class="text-sm text-gray-500 mt-2 text-center">Anda harus login terlebih dahulu
                                            untuk menambahkan produk ke keranjang</p>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="mt-6">
                                    <button disabled
                                        class="w-full bg-gray-400 text-white px-6 py-3 rounded-md font-medium cursor-not-allowed">
                                        Stok Habis
                                    </button>
                                </div>
                            <?php endif; ?>

                            <!-- Deskripsi -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900 mb-3">Deskripsi Produk</h3>
                                <p class="text-gray-600 leading-relaxed"><?php echo e($product->deskripsi); ?></p>
                            </div>

                            <!-- Detail Buku -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900 mb-3">Detail Buku</h3>
                                <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                                    <div>
                                        <span class="font-medium">Halaman:</span> <?php echo e($product->halaman ?? '-'); ?>

                                    </div>
                                    <div>
                                        <span class="font-medium">Panjang:</span>
                                        <?php echo e($product->panjang && $product->lebar ? $product->panjang . 'cm x ' . $product->lebar . 'cm' : '-'); ?>

                                    </div>
                                    <div>
                                        <span class="font-medium">Berat:</span>
                                        <?php echo e($product->berat ? $product->berat . ' gram' : '-'); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifikasi -->
    <div id="notification" class="fixed bottom-4 right-4 hidden z-50">
        <div class="bg-[#0ABAB5] text-white px-4 py-3 rounded-md shadow-lg flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span id="notification-message"></span>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi showNotification
        function showNotification(message, isError = false) {
            const notification = document.getElementById('notification');
            const messageEl = document.getElementById('notification-message');

            // Set pesan
            messageEl.textContent = message;

            notification.firstElementChild.className = isError
                ? 'bg-red-500 text-white px-4 py-3 rounded-md shadow-lg flex items-center'
                : 'bg-[#0ABAB5] text-white px-4 py-3 rounded-md shadow-lg flex items-center';

            // Set ikon
            notification.firstElementChild.innerHTML = `
                <i class="fas ${isError ? 'fa-exclamation-circle' : 'fa-check-circle'} mr-2"></i>
                <span id="notification-message">${message}</span>
            `;

            // Tampilkan notifikasi
            notification.classList.remove('hidden');

            // Sembunyikan setelah 3 detik
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 5000);
        }

        // Tangani form penambahan ke keranjang
        document.querySelectorAll('.add-to-cart-form').forEach(form => {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const button = this.querySelector('.add-to-cart-btn');
                const btnText = button.querySelector('.btn-text');
                const btnLoading = button.querySelector('.btn-loading');
                const quantityInput = this.querySelector('.quantity-input');
                const productId = this.dataset.productId;
                const availableStock = parseInt(button.dataset.availableStock);
                const quantity = parseInt(quantityInput.value);

                // Validasi quantity
                if (quantity < 1) {
                    showNotification('Jumlah harus minimal 1', true);
                    return;
                }

                // Tampilkan loading state
                button.disabled = true;
                btnText.classList.add('hidden');
                btnLoading.classList.remove('hidden');

                try {
                    const response = await fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({
                            _token: '<?php echo e(csrf_token()); ?>',
                            quantity: quantity
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Update jumlah keranjang di navbar
                        updateCartCount(data.cartCount);

                        // Tampilkan notifikasi sukses
                        showNotification(data.message);

                        // Update stok yang tersedia
                        button.dataset.availableStock = data.availableStock;

                        // Update tampilan stok
                        // const stockBadge = document.querySelector('.bg-\\[\\#ADEED9\\]');
                        // if (stockBadge && data.availableStock > 0) {
                        //     stockBadge.textContent = `Stok Tersedia (${data.availableStock})`;
                        // } else if (stockBadge && data.availableStock <= 0) {
                        //     stockBadge.textContent = 'Stok Habis';
                        //     stockBadge.className = 'ml-4 px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800';
                        // }

                        // Reset button state
                        button.disabled = false;
                        btnLoading.classList.add('hidden');
                        btnText.classList.remove('hidden');

                    } else {
                        showNotification(data.message, true);
                        button.disabled = false;
                        btnLoading.classList.add('hidden');
                        btnText.classList.remove('hidden');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showNotification('Terjadi kesalahan', true);
                    button.disabled = false;
                    btnLoading.classList.add('hidden');
                    btnText.classList.remove('hidden');
                }
            });
        });

        // Fungsi update cart count
        function updateCartCount(count) {
            const cartCountElements = document.querySelectorAll('#cart-count, #cart-count-mobile');
            cartCountElements.forEach(el => {
                if (count > 0) {
                    el.textContent = count;
                    el.classList.remove('hidden');
                } else {
                    el.classList.add('hidden');
                }
            });
        }
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Allima-main\resources\views/produk-detail.blade.php ENDPATH**/ ?>