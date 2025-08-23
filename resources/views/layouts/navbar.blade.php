<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo dan Menu Utama -->
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center">
                    <span class="text-xl font-bold text-gray-800">'Allimna</span>
                </a>

                <!-- Menu Desktop -->
                <div class="hidden md:ml-8 md:flex md:space-x-4">
                    <a href="{{ route('home') }}"
                       class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'text-[#0ABAB5] bg-[#ADEED9]' : 'text-gray-600 hover:text-[#0ABAB5] hover:bg-[#ADEED9]' }}">
                       Beranda
                    </a>
                    <a href="{{ route('kontak') }}"
                       class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('kontak') ? 'text-[#0ABAB5] bg-[#ADEED9]' : 'text-gray-600 hover:text-[#0ABAB5] hover:bg-[#ADEED9]' }}">
                       Kontak
                    </a>
                </div>
            </div>

            <!-- Menu Kanan -->
            <div class="flex items-center space-x-4">
                <!-- Keranjang -->
                @auth
                    <a href="{{ route('cart.index') }}" class="p-1 rounded-full text-gray-600 hover:text-[#0ABAB5] relative group">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span id="cart-count"
                              class="cart-count {{ auth()->user()->cart_items_count == 0 ? 'hidden' : '' }} absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-[#0ABAB5] rounded-full">
                            {{ auth()->user()->cart_items_count }}
                        </span>
                        <span class="absolute -bottom-1 left-1/2 w-0 h-0.5 bg-[#0ABAB5] group-hover:w-1/2 group-hover:transition-all"></span>
                        <span class="absolute -bottom-1 right-1/2 w-0 h-0.5 bg-[#0ABAB5] group-hover:w-1/2 group-hover:transition-all"></span>
                    </a>
                @endauth

                <!-- Login/Logout -->
                @auth
                    <div class="hidden md:flex items-center space-x-4 ml-4">
                        <span class="text-sm text-gray-600">Halo, {{ Auth::user()->username }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-gray-600 hover:text-[#0ABAB5] flex items-center">
                                <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="hidden md:flex items-center text-sm text-gray-600 hover:text-[#0ABAB5] px-3 py-2">
                        <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                    </a>
                @endauth

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
            <a href="{{ route('home') }}"
               class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('home') ? 'text-[#0ABAB5] bg-[#ADEED9]' : 'text-gray-600 hover:text-[#0ABAB5] hover:bg-[#ADEED9]' }}">
               Beranda
            </a>
            <a href="{{ route('kontak') }}"
               class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('kontak') ? 'text-[#0ABAB5] bg-[#ADEED9]' : 'text-gray-600 hover:text-[#0ABAB5] hover:bg-[#ADEED9]' }}">
               Kontak
            </a>

            @auth
                <a href="{{ route('cart.index') }}"
                   class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('cart.*') ? 'text-[#0ABAB5] bg-[#ADEED9]' : 'text-gray-600 hover:text-[#0ABAB5] hover:bg-[#ADEED9]' }}">
                    <i class="fas fa-shopping-cart mr-2"></i> Keranjang
                    <span id="cart-count-mobile"
                          class="ml-1 {{ auth()->user()->cart_items_count == 0 ? 'hidden' : '' }} bg-[#0ABAB5] text-white text-xs px-2 py-0.5 rounded-full">
                        {{ auth()->user()->cart_items_count }}
                    </span>
                </a>

                <div class="border-t border-gray-200 pt-2">
                    <div class="flex items-center px-3 py-2">
                        <span class="text-base font-medium text-gray-600">Halo, {{ Auth::user()->username }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-[#0ABAB5] hover:bg-[#ADEED9]">
                            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}"
                   class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('login') ? 'text-[#0ABAB5] bg-[#ADEED9]' : 'text-gray-600 hover:text-[#0ABAB5] hover:bg-[#ADEED9]' }}">
                    <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                </a>
            @endauth
        </div>
    </div>
</nav>

<script>
    const menuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    menuButton?.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!mobileMenu.contains(e.target) && !menuButton.contains(e.target)) {
            mobileMenu.classList.add('hidden');
        }
    });

    // 🔥 Fungsi update jumlah keranjang (jumlah item unik)
    function updateCartCount(count) {
        const cartCount = document.getElementById('cart-count');
        const cartCountMobile = document.getElementById('cart-count-mobile');

        if (cartCount) {
            if (count > 0) {
                cartCount.textContent = count;
                cartCount.classList.remove('hidden');
            } else {
                cartCount.classList.add('hidden');
            }
        }

        if (cartCountMobile) {
            if (count > 0) {
                cartCountMobile.textContent = count;
                cartCountMobile.classList.remove('hidden');
            } else {
                cartCountMobile.classList.add('hidden');
            }
        }
    }

    // 🔥 Fungsi AJAX tambah produk ke keranjang
    async function addToCart(productId, quantity = 1) {
        try {
            const response = await fetch(`/cart/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ quantity })
            });

            const data = await response.json();

            if (data.success) {
                // Update jumlah item unik di keranjang
                updateCartCount(data.cartCount);

                // Tampilkan notifikasi sukses
                showNotification(data.message, false);
            } else {
                // Tampilkan notifikasi error
                showNotification(data.message, true);
            }
        } catch (error) {
            console.error('Error:', error);
            showNotification("Terjadi kesalahan saat menambahkan ke keranjang", true);
        }
    }

    // 🔥 Fungsi untuk menampilkan notifikasi
    function showNotification(message, isError = false) {
        // Cari elemen notifikasi yang sudah ada atau buat baru
        let notification = document.getElementById('global-notification');

        if (!notification) {
            notification = document.createElement('div');
            notification.id = 'global-notification';
            notification.className = 'fixed bottom-4 right-4 z-50';
            document.body.appendChild(notification);
        }

        notification.innerHTML = `
            <div class="${isError ? 'bg-red-500' : 'bg-[#0ABAB5]'} text-white px-6 py-4 rounded-lg shadow-lg flex items-center animate-fadeIn">
                <i class="fas ${isError ? 'fa-exclamation-circle' : 'fa-check-circle'} mr-3"></i>
                <span>${message}</span>
            </div>
        `;

        // Sembunyikan notifikasi setelah 3 detik
        setTimeout(() => {
            notification.innerHTML = '';
        }, 3000);
    }

    // Style untuk animasi notifikasi
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }
    `;
    document.head.appendChild(style);
</script>
