@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Produk: {{ $product->judul }}</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div>
                    <div class="mb-4">
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Buku</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $product->judul) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="penulis" class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                        <input type="text" name="penulis" id="penulis" value="{{ old('penulis', $product->penulis) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('penulis')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                        <input type="number" name="harga" id="harga" value="{{ old('harga', $product->harga) }}" min="0" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('harga')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="stok" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                        <input type="number" name="stok" id="stok" value="{{ old('stok', $product->stok) }}" min="0" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('stok')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div>
                    <div class="mb-4">
                        <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto Cover</label>
                        @if($product->foto)
                            <div class="mb-2">
                                <img src="{{ $product->foto_url }}" alt="{{ $product->judul }}" class="h-32 w-auto">
                            </div>
                        @endif
                        <input type="file" name="foto" id="foto"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('foto')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="halaman" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Halaman</label>
                        <input type="number" name="halaman" id="halaman" value="{{ old('halaman', $product->halaman) }}" min="1"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('halaman')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="bahasa" class="block text-sm font-medium text-gray-700 mb-1">Bahasa</label>
                        <select name="bahasa" id="bahasa" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="Indonesia" {{ old('bahasa', $product->bahasa) == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                            <option value="Inggris" {{ old('bahasa', $product->bahasa) == 'Inggris' ? 'selected' : '' }}>Inggris</option>
                            <option value="Lainnya" {{ old('bahasa', $product->bahasa) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('bahasa')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label for="panjang" class="block text-sm font-medium text-gray-700 mb-1">Panjang (cm)</label>
                    <input type="number" step="0.01" name="panjang" id="panjang" value="{{ old('panjang', $product->panjang) }}" min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('panjang')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="lebar" class="block text-sm font-medium text-gray-700 mb-1">Lebar (cm)</label>
                    <input type="number" step="0.01" name="lebar" id="lebar" value="{{ old('lebar', $product->lebar) }}" min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('lebar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="berat" class="block text-sm font-medium text-gray-700 mb-1">Berat (gram)</label>
                    <input type="number" step="0.01" name="berat" id="berat" value="{{ old('berat', $product->berat) }}" min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('berat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Update Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
