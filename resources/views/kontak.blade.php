@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-[#0ABAB5]">Hubungi PP. Al-Hikmah</h1>
            <p class="mt-3 text-gray-600 max-w-2xl mx-auto">Silakan hubungi kami melalui informasi kontak berikut atau kunjungi langsung pesantren kami.</p>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Contact Information Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-[#0ABAB5] mb-6">Informasi Kontak</h2>

                    <div class="space-y-6">
                        <!-- Address -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-[#0ABAB5]/10 p-2 rounded-lg">
                                <i class="fas fa-map-marker-alt text-[#0ABAB5] text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-800">Alamat Lengkap</h3>
                                <p class="mt-1 text-gray-600">
                                    PP. Al-Hikmah, Desa Kesilir, Kec. Wuluhan<br>
                                    Kabupaten Jember, Jawa Timur 68162<br>
                                    Indonesia
                                </p>
                            </div>
                        </div>

                        <!-- Phone/WhatsApp -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-[#0ABAB5]/10 p-2 rounded-lg">
                                <i class="fas fa-phone-alt text-[#0ABAB5] text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-800">Telepon/WhatsApp</h3>
                                <p class="mt-1 text-gray-600">0823-1607-9651</p>
                                <a href="https://wa.me/6282316079651"
                                   target="_blank"
                                   class="inline-flex items-center mt-2 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition duration-200">
                                    <i class="fab fa-whatsapp mr-2"></i> Chat Sekarang
                                </a>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-[#0ABAB5]/10 p-2 rounded-lg">
                                <i class="fas fa-envelope text-[#0ABAB5] text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-800">Email</h3>
                                <p class="mt-1 text-gray-600">mabintpqmaarifnu.allimna@gmail.com</p>
                                <a href="mailto:mabintpqmaarifnu.allimna@gmail.com"
                                   class="inline-flex items-center mt-2 px-4 py-2 bg-[#0ABAB5] hover:bg-[#089B9B] text-white rounded-lg transition duration-200">
                                    <i class="fas fa-paper-plane mr-2"></i> Kirim Email
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-[#0ABAB5] mb-6">Lokasi Kami</h2>

                    <!-- Map Container -->
                    <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.322389963271!2d113.65360931536484!3d-8.455870794404785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOMKwMjcnMjEuMSJTIDExM8KwMzknMTkuNyJF!5e0!3m2!1sen!2sid!4v1621234567890!5m2!1sen!2sid"
                            width="100%"
                            height="100%"
                            style="border:0; min-height: 350px;"
                            allowfullscreen=""
                            loading="lazy"
                            class="rounded-lg">
                        </iframe>
                    </div>

                    <!-- Map Actions -->
                    <div class="mt-4 flex flex-col sm:flex-row gap-3">
                        <a href="https://maps.google.com/?q=PP.+Al-Hikmah+Kesilir+Wuluhan+Jember"
                           target="_blank"
                           class="flex-1 text-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition duration-200">
                            <i class="fas fa-map-marked-alt mr-2"></i> Buka di Google Maps
                        </a>
                        <a href="https://www.google.com/maps/dir//PP.+Al-Hikmah+Kesilir+Wuluhan+Jember/data=!4m6!4m5!1m1!4e2!1m2!1m1!1s0x2dd6932a12a30a0d:0x3039d80b220cc40?sa=X&ved=1t:3061&ictx=111"
                           target="_blank"
                           class="flex-1 text-center px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-800 rounded-lg transition duration-200">
                            <i class="fas fa-directions mr-2"></i> Petunjuk Arah
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
