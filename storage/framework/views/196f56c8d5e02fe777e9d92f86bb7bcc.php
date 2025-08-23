<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-blue-800 text-white">
                <div class="flex items-center justify-center h-16 px-4 bg-blue-900">
                    <span class="text-xl font-bold"><?php echo e(config('app.name')); ?></span>
                </div>
                <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
                    <nav class="flex-1 space-y-2">
                        <a href="<?php echo e(route('admin.dashboard')); ?>"
                            class="flex items-center px-4 py-2 text-sm font-medium rounded-lg <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-blue-700' : 'hover:bg-blue-700'); ?>">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                        <a href="<?php echo e(route('admin.sales.index')); ?>"
                            class="flex items-center px-4 py-2 text-sm font-medium rounded-lg <?php echo e(request()->routeIs('admin.sales.*') ? 'bg-blue-700' : 'hover:bg-blue-700'); ?>">
                            <i class="fas fa-shopping-cart mr-3"></i>
                            Manajemen Penjualan
                        </a>
                        <a href="<?php echo e(route('admin.products.index')); ?>"
                            class="flex items-center px-4 py-2 text-sm font-medium rounded-lg <?php echo e(request()->routeIs('admin.products.*') ? 'bg-blue-700' : 'hover:bg-blue-700'); ?>">
                            <i class="fas fa-book mr-3"></i>
                            Manajemen Produk
                        </a>
                        <a href="<?php echo e(route('admin.users.index')); ?>"
                            class="flex items-center px-4 py-2 text-sm font-medium rounded-lg <?php echo e(request()->routeIs('admin.users.*') ? 'bg-blue-700' : 'hover:bg-blue-700'); ?>">
                            <i class="fas fa-users mr-3"></i>
                            Manajemen User
                        </a>
                        <!-- Account Settings -->
                        <div class="mt-4 border-t border-blue-700 pt-4">
                            <p class="px-4 py-2 text-sm font-semibold text-blue-300">Account Settings</p>
                            <a href="<?php echo e(route('admin.account.profile')); ?>"
                                class="flex items-center px-4 py-2 text-sm font-medium rounded-lg <?php echo e(request()->routeIs('admin.account.profile') ? 'bg-blue-700' : 'hover:bg-blue-700'); ?>">
                                <i class="fas fa-user mr-3"></i>
                                Profile
                            </a>

                            <a href="<?php echo e(route('admin.account.change-password')); ?>"
                                class="flex items-center px-4 py-2 text-sm font-medium rounded-lg <?php echo e(request()->routeIs('admin.account.change-password') ? 'bg-blue-700' : 'hover:bg-blue-700'); ?>">
                                <i class="fas fa-key mr-3"></i>
                                Change Password
                            </a>
                        </div>
                    </nav>
                </div>
                <div class="p-4 border-t border-blue-700">
                    <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                            class="flex items-center w-full px-4 py-2 text-sm font-medium text-left rounded-lg hover:bg-blue-700">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button class="md:hidden text-gray-500 focus:outline-none sidebar-toggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="text-xl font-semibold text-gray-800 ml-4"><?php echo $__env->yieldContent('title', 'Dashboard'); ?></h1>
                    </div>
                    <div class="flex items-center">
                        <span class="text-sm text-gray-600 mr-4"><?php echo e(Auth::guard('admin')->user()->username); ?></span>
                    </div>
                </div>
            </header>

            <!-- Notifikasi -->
            <?php if(session('success')): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mx-6 mt-4">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <p><?php echo e(session('success')); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mx-6 mt-4">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <p><?php echo e(session('error')); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Konten -->
            <main class="flex-1 overflow-y-auto p-6">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar -->
    <div class="fixed inset-0 z-40 md:hidden hidden" id="mobile-sidebar">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>
        <div class="relative flex flex-col w-72 max-w-xs h-full bg-blue-800">
            <div class="flex items-center justify-center h-16 px-4 bg-blue-900">
                <span class="text-xl font-bold text-white"><?php echo e(config('app.name')); ?></span>
                <button type="button" class="ml-auto p-2 rounded-md text-white focus:outline-none sidebar-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="flex-1 px-4 py-4 overflow-y-auto">
                <nav class="space-y-2">
                    <a href="<?php echo e(route('admin.dashboard')); ?>"
                        class="flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-blue-700' : 'hover:bg-blue-700'); ?>">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="<?php echo e(route('admin.sales.index')); ?>"
                        class="flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg <?php echo e(request()->routeIs('admin.sales.*') ? 'bg-blue-700' : 'hover:bg-blue-700'); ?>">
                        <i class="fas fa-shopping-cart mr-3"></i>
                        Penjualan
                    </a>
                    <a href="<?php echo e(route('admin.products.index')); ?>"
                        class="flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg <?php echo e(request()->routeIs('admin.products.*') ? 'bg-blue-700' : 'hover:bg-blue-700'); ?>">
                        <i class="fas fa-book mr-3"></i>
                        Produk
                    </a>
                    <a href="<?php echo e(route('admin.users.index')); ?>"
                        class="flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg <?php echo e(request()->routeIs('admin.users.*') ? 'bg-blue-700' : 'hover:bg-blue-700'); ?>">
                        <i class="fas fa-users mr-3"></i>
                        User
                    </a>
                    <div class="mt-4 border-t border-blue-700 pt-4">
                        <p class="px-4 py-2 text-sm font-semibold text-blue-300">Account Settings</p>
                        <a href="<?php echo e(route('admin.account.profile')); ?>"
                            class="flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg <?php echo e(request()->routeIs('admin.account.profile') ? 'bg-blue-700' : 'hover:bg-blue-700'); ?>">
                            <i class="fas fa-user mr-3"></i>
                            Profile
                        </a>

                        <a href="<?php echo e(route('admin.account.change-password')); ?>"
                            class="flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg <?php echo e(request()->routeIs('admin.account.change-password') ? 'bg-blue-700' : 'hover:bg-blue-700'); ?>">
                            <i class="fas fa-key mr-3"></i>
                            Change Password
                        </a>
                    </div>
                </nav>
            </div>
            <div class="p-4 border-t border-blue-700">
                <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit"
                        class="flex items-center w-full px-4 py-2 text-sm font-medium text-left text-white rounded-lg hover:bg-blue-700">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    // Toggle sidebar mobile
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebarClose = document.querySelector('.sidebar-close');
    const mobileSidebar = document.getElementById('mobile-sidebar');

    sidebarToggle.addEventListener('click', () => {
        mobileSidebar.classList.remove('hidden');
    });

    sidebarClose.addEventListener('click', () => {
        mobileSidebar.classList.add('hidden');
    });

    // Klik di overlay untuk menutup
    mobileSidebar.querySelector('div[aria-hidden="true"]').addEventListener('click', () => {
        mobileSidebar.classList.add('hidden');
    });
</script>
<?php /**PATH E:\Pandu-Projek\web-buku-main\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>