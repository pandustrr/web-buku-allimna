<?php $__env->startSection('title', 'Edit Profil Admin'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Edit Profil Admin</h2>

            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-800 p-3 mb-5 rounded">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('admin.account.profile.update')); ?>" class="space-y-5">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div>
                    <label for="name" class="block mb-2 font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="<?php echo e(old('name', $admin->name)); ?>"
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="username" class="block mb-2 font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo e(old('username', $admin->username)); ?>"
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\Allima-main\resources\views/admin/account/profile.blade.php ENDPATH**/ ?>