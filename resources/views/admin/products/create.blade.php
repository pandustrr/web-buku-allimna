@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Produk Baru</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div>
                    <div class="mb-4">
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Buku <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0ABAB5] focus:border-[#0ABAB5]">
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="penulis" class="block text-sm font-medium text-gray-700 mb-1">Penulis <span class="text-red-500">*</span></label>
                        <input type="text" name="penulis" id="penulis" value="{{ old('penulis') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0ABAB5] focus:border-[#0ABAB5]">
                        @error('penulis')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="harga" id="harga" value="{{ old('harga') }}" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0ABAB5] focus:border-[#0ABAB5]">
                        @error('harga')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="stok" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                        <input type="number" name="stok" id="stok" value="{{ old('stok', 0) }}" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0ABAB5] focus:border-[#0ABAB5]">
                        @error('stok')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div>
                    <div class="mb-4">
                        <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto Cover</label>
                        <input type="file" name="foto" id="foto" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0ABAB5] focus:border-[#0ABAB5]">
                        @error('foto')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="halaman" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Halaman</label>
                        <input type="number" name="halaman" id="halaman" value="{{ old('halaman') }}" min="1"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0ABAB5] focus:border-[#0ABAB5]">
                        @error('halaman')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi <span class="text-red-500">*</span></label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0ABAB5] focus:border-[#0ABAB5]">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label for="panjang" class="block text-sm font-medium text-gray-700 mb-1">Panjang (cm)</label>
                    <input type="number" step="0.01" name="panjang" id="panjang" value="{{ old('panjang') }}" min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0ABAB5] focus:border-[#0ABAB5]">
                    @error('panjang')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="lebar" class="block text-sm font-medium text-gray-700 mb-1">Lebar (cm)</label>
                    <input type="number" step="0.01" name="lebar" id="lebar" value="{{ old('lebar') }}" min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0ABAB5] focus:border-[#0ABAB5]">
                    @error('lebar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="berat" class="block text-sm font-medium text-gray-700 mb-1">Berat (gram)</label>
                    <input type="number" step="0.01" name="berat" id="berat" value="{{ old('berat') }}" min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0ABAB5] focus:border-[#0ABAB5]">
                    @error('berat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition text-center">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-[#0ABAB5] text-white rounded hover:bg-[#56DFCF] transition">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
