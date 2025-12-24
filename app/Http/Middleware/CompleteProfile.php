<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CompleteProfile
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
        if (!$user) {
            return $next($request);
        }

        // Only enforce profile completion for siswa (legacy roles_id == 1)
        // but skip enforcement if the `profil_siswa` table doesn't exist (prevents fatal errors on fresh/partial DBs)
        if (Schema::hasTable('profil_siswa') && isset($user->roles_id) && $user->roles_id == 1) {
            try {
                if (! $user->isComplete()) {
                    return redirect()->route('siswa.profile.complete');
                }
            } catch (\Throwable $e) {
                // If anything goes wrong (missing columns/tables), skip enforcement and continue
                // Log a debug message for future inspection
                logger()->debug('CompleteProfile middleware skipped due to error: '.$e->getMessage());
            }
        }

        return $next($request);
    }
}