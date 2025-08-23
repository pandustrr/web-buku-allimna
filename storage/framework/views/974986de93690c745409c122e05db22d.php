<?php $__env->startSection('title', 'Manajemen User'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded shadow p-6">
    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?php echo e(session('success')); ?>

            <?php if(session('new_password')): ?>
                <div class="mt-2 font-mono">Password: <span class="font-bold"><?php echo e(session('new_password')); ?></span></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Daftar User</h2>
        <a href="<?php echo e(route('admin.users.create')); ?>" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Tambah User
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left">No</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left">Username</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left">Password</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="py-2 px-4 border-b border-gray-200"><?php echo e($loop->iteration + ($users->perPage() * ($users->currentPage() - 1))); ?></td>
                    <td class="py-2 px-4 border-b border-gray-200"><?php echo e($user->username); ?></td>
                    <td class="py-2 px-4 border-b border-gray-200 font-mono">
                        <?php if($user->temp_password): ?>
                            <div class="flex items-center">
                                <span class="password-field" id="password-<?php echo e($user->id); ?>">••••••••</span>
                                <button
                                    type="button"
                                    onclick="togglePassword('<?php echo e($user->id); ?>', '<?php echo e($user->temp_password); ?>')"
                                    class="ml-2 text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded hover:bg-gray-300"
                                >
                                    Tampilkan
                                </button>
                                <button
                                    type="button"
                                    onclick="copyToClipboard('<?php echo e($user->temp_password); ?>')"
                                    class="ml-1 text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded hover:bg-blue-200"
                                    title="Salin password"
                                >
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        <?php else: ?>
                            <span class="text-gray-400">Belum di-set</span>
                        <?php endif; ?>
                    </td>
                    <td class="py-2 px-4 border-b border-gray-200">
                        <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Hapus user ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <?php echo e($users->links()); ?>

    </div>
</div>

<script>
    function togglePassword(userId, password) {
        const field = document.getElementById('password-' + userId);
        const button = event.target;

        if (field.textContent === '••••••••') {
            field.textContent = password;
            button.textContent = 'Sembunyikan';
        } else {
            field.textContent = '••••••••';
            button.textContent = 'Tampilkan';
        }
    }

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text)
            .then(() => alert('Password berhasil disalin: ' + text))
            .catch(err => console.error('Gagal menyalin: ', err));
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Pandu-Projek\e-com\resources\views/admin/users/index.blade.php ENDPATH**/ ?>