@extends('admin.layouts.app')

@section('title', 'Edit Profil Admin')

@section('content')
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Edit Profil Admin</h2>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-800 p-3 mb-5 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.account.profile.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block mb-2 font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}"
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="username" class="block mb-2 font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username', $admin->username) }}"
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @error('username')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
@endsection
