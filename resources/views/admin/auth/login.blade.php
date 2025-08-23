<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .login-bg {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/images/admin-bg.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="login-bg">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">
                    <i class="fas fa-lock mr-2 text-blue-600"></i>
                    Admin Panel
                </h1>
                <p class="text-gray-600 mt-2">Silakan login untuk melanjutkan</p>
            </div>

            {{-- Pesan sukses (misalnya setelah logout) --}}
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Pesan error validasi --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Login --}}
            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-medium mb-2">
                        <i class="fas fa-user mr-2 text-blue-500"></i>Username
                    </label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan username">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-medium mb-2">
                        <i class="fas fa-key mr-2 text-blue-500"></i>Password
                    </label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan password">
                </div>

                <div class="mb-4 flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="mr-2">
                    <label for="remember" class="text-gray-700">Ingat saya</label>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-md transition duration-300 flex items-center justify-center">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>
            </form>
        </div>
    </div>
</body>

</html>
