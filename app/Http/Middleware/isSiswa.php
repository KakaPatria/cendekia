<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isSiswa
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
        // Check if user is logged in AND is a Siswa (roles_id == 1)
        if(Auth::user() && Auth::user()->roles_id == 1) 
        {
            return $next($request);
        }
        
        // If not siswa, logout and redirect
        if(Auth::user()) {
            Auth::logout();
            return redirect()->route('siswa.login')->with('error', 'Akses hanya untuk siswa.');
        }
        
        abort(403, 'Unauthorized');
    
    }
}
