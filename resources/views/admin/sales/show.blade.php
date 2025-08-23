@extends('admin.layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="bg-white rounded shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold">Detail Pesanan #{{ $order->order_number }}</h2>
            <div class="flex items-center space-x-2">
                <span
                    class="px-3 py-1 rounded-full text-sm font-medium
                @if ($order->status === 'completed') bg-green-100 text-green-800
                @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                @else bg-yellow-100 text-yellow-800 @endif">
                    {{ ucfirst($order->status) }}
                </span>
                <form action="{{ route('admin.sales.update-status', $order) }}" method="POST">
                    @csrf
                    <select name="status" onchange="this.form.submit()"
                        class="border rounded px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="diproses" {{ $order->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ $order->status === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan
                        </option>
                    </select>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-medium mb-4">Informasi Pelanggan</h3>
                <div class="space-y-2">
                    <p><span class="font-medium">Nama:</span> {{ $order->customer_name }}</p>
                    <p><span class="font-medium">PGTPQ:</span> {{ $order->pgtpq }}</p>
                    <p><span class="font-medium">Alamat:</span> {{ $order->address }}</p>
                    <p><span class="font-medium">Catatan:</span> {{ $order->notes ?? '-' }}</p>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-medium mb-4">Ringkasan Pesanan</h3>
                <div class="space-y-2">
                    <p><span class="font-medium">Tanggal:</span> {{ $order->created_at->format('d M Y H:i') }}</p>
                    <p><span class="font-medium">No. Pesanan:</span> {{ $order->order_number }}</p>
                    <p><span class="font-medium">Total:</span> Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-medium mb-4">Daftar Produk</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left">Produk</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left">Harga</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left">Jumlah</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $item->product->judul }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">Rp
                                    {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $item->quantity }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">Rp
                                    {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.sales.index') }}"
                class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                Kembali ke Daftar
            </a>
        </div>
    </div>
@endsection
