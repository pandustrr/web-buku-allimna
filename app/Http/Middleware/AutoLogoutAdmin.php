<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AutoLogoutAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            $lastActivity = session('last_activity_admin');
            $now = Carbon::now()->timestamp;

            // Timeout (detik), misalnya 60 detik
            $timeout = 60;

            if ($lastActivity && ($now - $lastActivity > $timeout)) {
                Auth::guard('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('admin.login')
                    ->with('status', 'Sesi admin berakhir, silakan login kembali.');
            }

            session(['last_activity_admin' => $now]);
        }

        return $next($request);
    }
}
