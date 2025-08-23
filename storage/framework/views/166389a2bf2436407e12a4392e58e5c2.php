<footer class="bg-[#0ABAB5] text-white mt-12">
    <div class="container mx-auto px-6 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Link Cepat -->
            <div>
                <h3 class="text-lg font-bold mb-4">Link Cepat</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="<?php echo e(route('home')); ?>" class="text-white hover:text-gray-200">Beranda</a>
                    </li>
                    <li>
                        <a href="#" class="text-white hover:text-gray-200">Kontak</a>
                    </li>
                </ul>
            </div>

            <!-- Kantor Seketariatan -->
            <div>
                <h3 class="text-lg font-bold mb-4">Kantor Seketariatan</h3>

                <!-- Hubungi Kami -->
                <h4 class="text-md font-semibold mb-2 text-white">Hubungi Kami</h4>
                <ul class="space-y-2 text-white">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Kesilir-Wuluhan-Jember, Jawa Timur, Indonesia</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-phone-alt"></i>
                        <span>082316079651</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-envelope"></i>
                        <span>mabintpqmaarifnu.allimna@gmail.com</span>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Copyright -->
        <div class="border-t border-white/50 mt-8 pt-6 text-center text-white text-sm">
            &copy; <?php echo e(date('Y')); ?> PP. Al-Hikmah. All rights reserved.
        </div>
    </div>
</footer>
<?php /**PATH E:\Pandu-Projek\web-buku-main\resources\views/layouts/footer.blade.php ENDPATH**/ ?>