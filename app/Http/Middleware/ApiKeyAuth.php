<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Read-only API access: the caller must send a key created in Admin → API Access,
 * either as "X-API-KEY: <key>" or "Authorization: Bearer <key>".
 */
class ApiKeyAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $key = ApiKey::findActiveByPlain($request->header('X-API-KEY') ?: $request->bearerToken());

        if (! $key) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or missing API key. Send it in the X-API-KEY header.',
            ], 401);
        }

        // Only write when stale, so heavy polling doesn't update the row on every request
        if (! $key->last_used_at || $key->last_used_at->lt(now()->subMinute())) {
            $key->forceFill(['last_used_at' => now()])->save();
        }

        return $next($request);
    }
}
