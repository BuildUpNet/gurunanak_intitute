<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

trait HasSpamProtection
{
    /**
     * Bots either fill the hidden honeypot field or submit faster than a human
     * could possibly fill the form (form_rendered_at is stamped at render time).
     */
    protected function isBot(Request $request): bool
    {
        if ($request->filled('website')) {
            return true;
        }

        $renderedAt = (int) $request->input('form_rendered_at');

        return $renderedAt > 0 && (time() - $renderedAt) < 3;
    }

    protected function passesRecaptcha(Request $request): bool
    {
        $secret = env('RECAPTCHA_SECRET_KEY');

        if (empty($secret)) {
            // No secret configured yet — skip verification rather than block real submissions.
            return true;
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secret,
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        return (bool) ($response->json('success') ?? false);
    }
}
