<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class UserAktifMiddleware
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
        $user = $request->user();

        // if not authenticated, skip
        if (! $user) {
            return $next($request);
        }

        // Only enforce 'Aktif' status for siswa (legacy roles_id == 1)
        // if profil_siswa table is missing, skip to avoid fatal SQL errors
        if (Schema::hasTable('profil_siswa') && isset($user->roles_id) && $user->roles_id == 1) {
            try {
                if ($user->status !== 'Aktif') {
                    return redirect()->route('siswa.profile.complete');
                }
            } catch (\Throwable $e) {
                logger()->debug('UserAktifMiddleware skipped due to error: '.$e->getMessage());
            }
        }
        return $next($request);
    }
}
