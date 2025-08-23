@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="bg-white rounded shadow p-6 max-w-lg mx-auto">
    <h2 class="text-xl font-semibold mb-6">Edit User</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="username" class="block text-gray-700 mb-2">Username</label>
            <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('username')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 mb-2">Password Baru</label>
            <div class="relative">
                <input type="password" name="password" id="password" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Kosongkan jika tidak ingin mengubah">
                <button type="button" onclick="togglePasswordVisibility('password')" class="absolute right-3 top-2 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block text-gray-700 mb-2">Konfirmasi Password Baru</label>
            <div class="relative">
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="button" onclick="togglePasswordVisibility('password_confirmation')" class="absolute right-3 top-2 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.users.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2 hover:bg-gray-400">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>

<script>
    function togglePasswordVisibility(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.nextElementSibling.querySelector('i');

        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>
@endsection
