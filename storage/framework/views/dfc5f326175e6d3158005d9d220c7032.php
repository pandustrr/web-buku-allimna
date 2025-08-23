<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo dan Menu Utama -->
            <div class="flex items-center">
                <!-- Logo -->
                <a href="<?php echo e(route('home')); ?>" class="flex items-center">
                    <span class="text-xl font-bold text-gray-800">'Allimna</span>
                </a>

                <!-- Menu Desktop -->
                <div class="hidden md:ml-8 md:flex md:space-x-4">
                    <a href="<?php echo e(route('home')); ?>"
                       class="px-3 py-2 rounded-md text-sm font-medium <?php echo e(request()->routeIs('home') ? 'text-[#0ABAB5] bg-[#ADEED9]' : 'text-gray-600 hover:text-[#0ABAB5] hover:bg-[#ADEED9]'); ?>">
                       Beranda
                    </a>
                    <a href="<?php echo e(route('kontak')); ?>"
                       class="px-3 py-2 rounded-md text-sm font-medium <?php echo e(request()->routeIs('kontak') ? 'text-[#0ABAB5] bg-[#ADEED9]' : 'text-gray-600 hover:text-[#0ABAB5] hover:bg-[#ADEED9]'); ?>">
                       Kontak
                    </a>
                </div>
            </div>

            <!-- Menu Kanan -->
            <div class="flex items-center space-x-4">
                <!-- Keranjang -->
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('cart.index')); ?>" class="p-1 rounded-full text-gray-600 hover:text-[#0ABAB5] relative group">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span class="cart-count <?php echo e(auth()->user()->cart_items_count == 0 ? 'hidden' : ''); ?> absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-[#0ABAB5] rounded-full">
                            <?php echo e(auth()->user()->cart_items_count); ?>

                        </span>
                        <span class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-[#0ABAB5] group-hover:w-1/2 group-hover:transition-all"></span>
                        <span class="absolute -bottom-1 right-1/2 w-0 h-0.5 bg-[#0ABAB5] group-hover:w-1/2 group-hover:transition-all"></span>
                    </a>
                <?php endif; ?>

                <!-- Login/Logout -->
                <?php if(auth()->guard()->check()): ?>
                    <div class="hidden md:flex items-center space-x-4 ml-4">
                        <span class="text-sm text-gray-600">Halo, <?php echo e(Auth::user()->username); ?></span>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-sm text-gray-600 hover:text-[#0ABAB5] flex items-center">
                                <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                            </button>
                        </form>
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="hidden md:flex items-center text-sm text-gray-600 hover:text-[#0ABAB5] px-3 py-2">
                        <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                    </a>
                <?php endif; ?>

                <!-- Tombol Menu Mobile -->
                <div class="md:hidden ml-2">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-[#0ABAB5] hover:bg-[#ADEED9] focus:outline-none mobile-menu-button">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t border-gray-100">
            <a href="<?php echo e(route('home')); ?>"
               class="block px-3 py-2 rounded-md text-base font-medium <?php echo e(request()->routeIs('home') ? 'text-[#0ABAB5] bg-[#ADEED9]' : 'text-gray-600 hover:text-[#0ABAB5] hover:bg-[#ADEED9]'); ?>">
               Beranda
            </a>
            <a href="<?php echo e(route('kontak')); ?>"
               class="block px-3 py-2 rounded-md text-base font-medium <?php echo e(request()->routeIs('kontak') ? 'text-[#0ABAB5] bg-[#ADEED9]' : 'text-gray-600 hover:text-[#0ABAB5] hover:bg-[#ADEED9]'); ?>">
               Kontak
            </a>

            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('cart.index')); ?>"
                   class="block px-3 py-2 rounded-md text-base font-medium <?php echo e(request()->routeIs('cart.*') ? 'text-[#0ABAB5] bg-[#ADEED9]' : 'text-gray-600 hover:text-[#0ABAB5] hover:bg-[#ADEED9]'); ?>">
                    <i class="fas fa-shopping-cart mr-2"></i> Keranjang
                    <span class="ml-1 bg-[#0ABAB5] text-white text-xs px-2 py-0.5 rounded-full">
                        <?php echo e(auth()->user()->cart_items_count); ?>

                    </span>
                </a>

                <div class="border-t border-gray-200 pt-2">
                    <div class="flex items-center px-3 py-2">
                        <span class="text-base font-medium text-gray-600">Halo, <?php echo e(Auth::user()->username); ?></span>
                    </div>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-[#0ABAB5] hover:bg-[#ADEED9]">
                            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                        </button>
                    </form>
                </div>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>"
                   class="block px-3 py-2 rounded-md text-base font-medium <?php echo e(request()->routeIs('login') ? 'text-[#0ABAB5] bg-[#ADEED9]' : 'text-gray-600 hover:text-[#0ABAB5] hover:bg-[#ADEED9]'); ?>">
                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script>
    const menuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    menuButton?.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Tutup menu jika klik di luar
    document.addEventListener('click', (e) => {
        if (!mobileMenu.contains(e.target) && !menuButton.contains(e.target)) {
            mobileMenu.classList.add('hidden');
        }
    });
</script>

<?php /**PATH E:\Pandu-Projek\e-com\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>