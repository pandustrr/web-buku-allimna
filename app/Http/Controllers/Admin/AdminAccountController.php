<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class AdminAccountController extends Controller
{
    public function editProfile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.account.profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                'unique:admins,username,'.$admin->id,
                'regex:/^[a-zA-Z0-9_]+$/'
            ],
        ], [
            'username.regex' => 'Username hanya boleh berisi huruf, angka, dan underscore'
        ]);

        $admin->update($validated);

        return redirect()->route('admin.account.profile')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    public function editPassword()
    {
        return view('admin.account.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini tidak sesuai.',
            ]);
        }

        $admin->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.account.change-password')
            ->with('success', 'Password berhasil diubah!');
    }
}
