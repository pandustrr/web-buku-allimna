@extends('admin.layouts.app')

@section('title', 'Ubah Password Admin')

@section('content')
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Ubah Password</h1>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-800 p-3 mb-5 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.account.change-password.update') }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-2 font-medium text-gray-700">Password Lama</label>
                    <input type="password" name="current_password"
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required>
                    @error('current_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 font-medium text-gray-700">Password Baru</label>
                    <input type="password" name="password"
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-2 font-medium text-gray-700">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation"
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200">
                    Simpan
                </button>
            </form>
        </div>
    </div>
@endsection
