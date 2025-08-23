@extends('admin.layouts.app')

@section('title', 'Manajemen User')

@section('content')
<div class="bg-white rounded shadow p-6">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
            @if(session('new_password'))
                <div class="mt-2 font-mono">Password: <span class="font-bold">{{ session('new_password') }}</span></div>
            @endif
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Daftar User</h2>
        <a href="{{ route('admin.users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Tambah User
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left">No</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left">Username</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left">Password</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $loop->iteration + ($users->perPage() * ($users->currentPage() - 1)) }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $user->username }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 font-mono">
                        @if($user->temp_password)
                            <div class="flex items-center">
                                <span class="password-field" id="password-{{ $user->id }}">••••••••</span>
                                <button
                                    type="button"
                                    onclick="togglePassword('{{ $user->id }}', '{{ $user->temp_password }}')"
                                    class="ml-2 text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded hover:bg-gray-300"
                                >
                                    Tampilkan
                                </button>
                                <button
                                    type="button"
                                    onclick="copyToClipboard('{{ $user->temp_password }}')"
                                    class="ml-1 text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded hover:bg-blue-200"
                                    title="Salin password"
                                >
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        @else
                            <span class="text-gray-400">Belum di-set</span>
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b border-gray-200">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>

<script>
    function togglePassword(userId, password) {
        const field = document.getElementById('password-' + userId);
        const button = event.target;

        if (field.textContent === '••••••••') {
            field.textContent = password;
            button.textContent = 'Sembunyikan';
        } else {
            field.textContent = '••••••••';
            button.textContent = 'Tampilkan';
        }
    }

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text)
            .then(() => alert('Password berhasil disalin: ' + text))
            .catch(err => console.error('Gagal menyalin: ', err));
    }
</script>
@endsection
