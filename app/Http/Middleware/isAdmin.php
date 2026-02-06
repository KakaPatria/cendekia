<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::user()) {
            return redirect()->route('panel.login');
        }

        $user = Auth::user();

        // Only accept Admin (roles_id == 2) or Pengajar (roles_id == 3)
        if ($user && isset($user->roles_id) && in_array($user->roles_id, [2,3])) {
            return $next($request);
        }
        
        // If siswa (roles_id == 1) tries to access, logout and redirect
        if ($user && $user->roles_id == 1) {
            Auth::logout();
            return redirect()->route('panel.login')->with('error', 'Akses ditolak. Silakan login sebagai Admin atau Pengajar.');
        }

        abort(403, 'Unauthorized');
    }
}
