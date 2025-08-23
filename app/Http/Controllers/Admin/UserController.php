<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'temp_password' => $request->password // Simpan password asli
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with([
                'success' => 'User berhasil ditambahkan!',
                'new_password' => $request->password // Untuk ditampilkan sekali
            ]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = ['username' => $request->username];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
            $data['temp_password'] = $request->password; // Update temp_password
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus!');
    }
}
