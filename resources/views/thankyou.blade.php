@extends('layouts.app')

@section('title', 'Terima Kasih')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md text-center max-w-md">
        <div class="text-green-500 text-6xl mb-4">
            <i class="fas fa-check-circle"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Terima Kasih atas Pesanan Anda!</h2>
        <p class="text-gray-600 mb-6">
            Pesanan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda via WhatsApp untuk konfirmasi lebih lanjut.
        </p>
        <a href="{{ route('home') }}" class="inline-block bg-[#0ABAB5] text-white px-6 py-2 rounded-md hover:bg-[#56DFCF] transition">
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
