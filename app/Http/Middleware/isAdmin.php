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

        // Accept users with Spatie roles Admin or Pengajar
        if ($user && $user->hasRole(['Admin','Pengajar'])) {
            return $next($request);
        }

        // Fallback: accept legacy roles_id values for backward compatibility
        if ($user && isset($user->roles_id) && in_array($user->roles_id, [2,3])) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
