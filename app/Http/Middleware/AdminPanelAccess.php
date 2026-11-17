<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Lets super admins and active staff into the admin panel. Runs on every
 * admin request, so disabling an account or its role signs that person out
 * on their very next click instead of waiting for the session to expire.
 */
class AdminPanelAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user->canUseAdminPanel()) {
            return $next($request);
        }

        if ($user) {
            Log::warning('Admin panel access revoked mid-session', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip(),
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->withErrors([
            'email' => 'Your account access has been disabled. Please contact the administrator.',
        ]);
    }
}
