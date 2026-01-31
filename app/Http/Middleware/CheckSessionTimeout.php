<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSessionTimeout
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = session('last_activity');
            $timeout = 300; // 5 minutes in seconds

            if ($lastActivity && (time() - $lastActivity > $timeout)) {
                Auth::logout();
                session()->invalidate();
                session()->regenerateToken();

                return redirect()->route('admin.login')
                    ->with('message', 'Sesi Anda telah berakhir karena tidak ada aktivitas.');
            }

            session(['last_activity' => time()]);
        }

        return $next($request);
    }
}
