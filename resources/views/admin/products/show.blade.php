@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Detail Produk: {{ $product->judul }}</h1>
        <div class="flex flex-col sm:flex-row gap-2">
            <a href="{{ route('admin.products.edit', $product->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-center">
                Edit
            </a>
            <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition text-center">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3 p-6 flex justify-center md:justify-start mb-6 md:mb-0">
                <img src="{{ $product->foto_url }}" alt="{{ $product->judul }}" class="w-full max-w-xs h-auto rounded-lg object-cover">
            </div>
            <div class="md:w-2/3 p-6 flex flex-col gap-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">{{ $product->judul }}</h2>
                    <p class="text-gray-600">Oleh: {{ $product->penulis }}</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Harga</p>
                        <p class="text-lg font-bold text-blue-600">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Stok Tersedia</p>
                        <p class="text-lg font-bold {{ $product->stok > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->stok }} buku
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Bahasa</p>
                        <p class="text-gray-800">{{ $product->bahasa }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Halaman</p>
                        <p class="text-gray-800">{{ $product->halaman ?? '-' }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi</h3>
                    <p class="text-gray-700 whitespace-pre-line">{{ $product->deskripsi }}</p>
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Detail Fisik</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Panjang</p>
                            <p class="text-gray-800">{{ $product->panjang ? $product->panjang.' cm' : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Lebar</p>
                            <p class="text-gray-800">{{ $product->lebar ? $product->lebar.' cm' : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Berat</p>
                            <p class="text-gray-800">{{ $product->berat ? $product->berat.' gram' : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
