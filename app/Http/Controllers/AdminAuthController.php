<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    /**
     * Menampilkan form login admin
     */
    public function showLoginForm()
    {
        // Kalau sudah login, langsung ke dashboard
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Proses login admin
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Normalisasi username biar lowercase
        $credentials['username'] = strtolower($credentials['username']);

        Log::debug('Percobaan login admin:', ['username' => $credentials['username']]);

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Log::info('Admin berhasil login', [
            //     'username' => $credentials['username'],
            //     'ip' => $request->ip()
            // ]);

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Login berhasil, selamat datang!');
        }

        Log::warning('Login gagal untuk admin', [
            'username' => $credentials['username'],
            'ip' => $request->ip()
        ]);

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    /**
     * Proses logout admin
     */
    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Log::info('Admin logout', [
                'username' => Auth::guard('admin')->user()->username,
                'ip' => $request->ip()
            ]);
        }

        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('status', 'Anda telah logout.');
    }
}
