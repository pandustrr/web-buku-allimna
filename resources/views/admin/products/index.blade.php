@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Produk</h1>
        <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition flex items-center gap-2">
            <i class="fas fa-plus"></i>
            <span>Tambah Produk</span>
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Cover</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Judul</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Penulis</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Harga</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Stok</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-4">
                        <div class="flex-shrink-0 h-16 w-12 overflow-hidden rounded">
                            <img src="{{ $product->foto_url }}" alt="{{ $product->judul }}" class="h-full w-full object-cover">
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="text-sm font-medium text-gray-900 max-w-xs truncate">{{ $product->judul }}</div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="text-sm text-gray-500 max-w-xs truncate">{{ $product->penulis }}</div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="text-sm text-gray-900">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                    </td>
                    <td class="px-4 py-4">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                            {{ $product->stok > 5 ? 'bg-green-100 text-green-800' : ($product->stok > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ $product->stok }}
                        </span>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               class="text-blue-600 hover:text-blue-900"
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('admin.products.show', $product->id) }}"
                               class="text-green-600 hover:text-green-900"
                               title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-900"
                                        title="Hapus"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                        Tidak ada produk ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
