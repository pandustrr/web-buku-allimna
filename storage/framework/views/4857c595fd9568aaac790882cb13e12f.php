<?php $__env->startSection('content'); ?>
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <div class="relative bg-gradient-to-r from-[#0ABAB5] to-[#06a69f] text-white">
            <div class="container mx-auto px-6 py-20 md:py-28 text-center relative z-10 max-w-3xl">
                <!-- Judul -->
                <h2 class="text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-lg">
                    Selamat Datang
                </h2>
                <h3 class="text-lg md:text-2xl mb-10 opacity-90">
                    Pusat Pengadaan Buku <span class="font-semibold italic">‘Allimna</span>
                </h3>

                <!-- Tombol -->
                <a href="#produk"
                    class="inline-block bg-white text-[#0ABAB5] font-bold rounded-full py-3 px-8 md:py-4 md:px-10 shadow-xl hover:bg-gray-100 hover:scale-105 transform transition duration-300 ease-in-out">
                    📚 Lihat Koleksi Buku
                </a>
            </div>

            <!-- Background dekorasi -->
            <div
                class="absolute inset-0 opacity-20 bg-[url('https://www.toptal.com/designers/subtlepatterns/patterns/books.png')] bg-cover">
            </div>
        </div>


        <!-- Product Section -->
        <section id="produk" class="container mx-auto px-4 sm:px-6 py-8 md:py-12">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 md:mb-8 text-center">Koleksi Buku</h2>

            <?php if($products->isEmpty()): ?>
                <div class="text-center py-12">
                    <p class="text-gray-600 text-lg">Belum ada buku yang tersedia saat ini.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div
                            class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300 flex flex-col h-full">
                            <a href="<?php echo e(route('product.show', $product->id)); ?>" class="flex-grow">
                                <div class="relative h-40 sm:h-48 md:h-56 overflow-hidden">
                                    <img src="<?php echo e($product->foto_url); ?>" alt="<?php echo e($product->judul); ?>"
                                        class="w-full h-full object-cover hover:scale-105 transition duration-300">
                                    <?php if($product->stok > 0): ?>
                                        <span
                                            class="absolute top-2 right-2 bg-[#56DFCF] text-white text-xs px-2 py-1 rounded-full">
                                            Stok: <?php echo e($product->stok); ?>

                                        </span>
                                    <?php else: ?>
                                        <span
                                            class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                            Stok Habis
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="p-3 md:p-4">
                                    <h3
                                        class="font-bold text-sm md:text-base lg:text-lg mb-1 md:mb-2 text-gray-800 line-clamp-2">
                                        <?php echo e($product->judul); ?></h3>
                                    <p class="text-gray-600 text-xs md:text-sm mb-2">Oleh: <?php echo e($product->penulis); ?></p>
                                    <span class="font-bold text-[#0ABAB5] text-sm md:text-base">
                                        Rp <?php echo e(number_format($product->harga, 0, ',', '.')); ?>

                                    </span>
                                </div>
                            </a>

                            <div class="p-3 md:p-4 pt-0">
                                <?php if($product->stok > 0): ?>
                                    <?php if(auth()->guard()->check()): ?>
                                        <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST"
                                            class="add-to-cart-form" data-product-id="<?php echo e($product->id); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit"
                                                class="w-full bg-[#0ABAB5] hover:bg-[#56DFCF] text-white text-center text-xs md:text-sm font-medium py-2 px-2 md:py-2 md:px-4 rounded transition duration-300 flex items-center justify-center add-to-cart-btn"
                                                data-available-stock="<?php echo e($product->stok); ?>">
                                                <i class="fas fa-cart-plus mr-2"></i>
                                                Tambah ke Keranjang
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('login')); ?>"
                                            class="w-full bg-[#0ABAB5] hover:bg-[#56DFCF] text-white text-center text-xs md:text-sm font-medium py-2 px-2 md:py-2 md:px-4 rounded transition duration-300 flex items-center justify-center">
                                            <i class="fas fa-sign-in-alt mr-2"></i>
                                            Login untuk Membeli
                                        </a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <button disabled
                                        class="w-full bg-gray-400 text-white text-center text-xs md:text-sm font-medium py-2 px-2 md:py-2 md:px-4 rounded cursor-not-allowed">
                                        Stok Habis
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </section>

        <div id="notification" class="fixed bottom-4 right-4 hidden z-50">
            <div class="bg-[#0ABAB5] text-white px-4 py-3 rounded-md shadow-lg flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span id="notification-message"></span>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Track quantity in cart for each product
            const productQuantities = {};

            // Fungsi showNotification
            function showNotification(message, isError = false) {
                const notification = document.getElementById('notification');
                const messageEl = document.getElementById('notification-message');

                // Set pesan
                messageEl.textContent = message;

                // Set warna berdasarkan jenis notifikasi
                notification.firstElementChild.className = isError ?
                    'bg-red-500 text-white px-4 py-3 rounded-md shadow-lg flex items-center' :
                    'bg-[#0ABAB5] text-white px-4 py-3 rounded-md shadow-lg flex items-center';

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

            // Tangani form tambah ke keranjang
            document.querySelectorAll('.add-to-cart-form').forEach(form => {
                const productId = form.dataset.productId;
                const button = form.querySelector('.add-to-cart-btn');
                const availableStock = parseInt(button.dataset.availableStock);

                // Initialize product quantity
                productQuantities[productId] = 0;

                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    // Cek jika sudah mencapai batas stok
                    if (productQuantities[productId] >= availableStock) {
                        showNotification(
                            'Tidak dapat menambah lagi, Keranjang sesuai dengan stok yang tersedia',
                            true);
                        return;
                    }

                    button.disabled = true;
                    const originalText = button.innerHTML;
                    button.innerHTML =
                        '<i class="fas fa-spinner fa-spin mr-2"></i>Menambahkan...';

                    try {
                        const response = await fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                            },
                            body: JSON.stringify({
                                _token: '<?php echo e(csrf_token()); ?>',
                                quantity: 1
                            })
                        });

                        const data = await response.json();

                        if (data.success) {
                            // Update jumlah keranjang di navbar
                            updateCartCount(data.cartCount);

                            // Update quantity in cart untuk produk ini
                            productQuantities[productId] += 1;

                            // Tampilkan notifikasi
                            showNotification(data.message);
                        } else {
                            showNotification(data.message, true);
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        showNotification('Terjadi kesalahan', true);
                    } finally {
                        // Selalu kembalikan tombol ke state semula
                        button.disabled = false;
                        button.innerHTML = originalText;
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Allima-main\resources\views/home.blade.php ENDPATH**/ ?>