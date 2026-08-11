<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HasSpamProtection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use HasSpamProtection;

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $throttleKey = Str::lower($credentials['email']) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            Log::warning('Admin login blocked: too many attempts', [
                'email' => $credentials['email'],
                'ip' => $request->ip(),
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
                ]);
        }

        // Bots that fill the honeypot or submit faster than humanly possible are
        // silently treated as a failed attempt, without leaking why to the client.
        if ($this->isBot($request)) {
            RateLimiter::hit($throttleKey, 60);

            Log::warning('Admin login blocked: bot detected', [
                'email' => $credentials['email'],
                'ip' => $request->ip(),
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Invalid email or password.',
                ]);
        }

        if (!$this->passesRecaptcha($request)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Please complete the reCAPTCHA verification.',
                ]);
        }

        if (!Auth::attempt($credentials)) {
            RateLimiter::hit($throttleKey, 60);

            Log::warning('Admin login failed: invalid credentials', [
                'email' => $credentials['email'],
                'ip' => $request->ip(),
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Invalid email or password.',
                ]);
        }

        if (Auth::user()->role !== 'admin') {
            Log::warning('Admin login denied: non-admin account', [
                'email' => $credentials['email'],
                'ip' => $request->ip(),
            ]);

            Auth::logout();
            RateLimiter::hit($throttleKey, 60);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Only admin can login.',
                ]);
        }

        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();

        Log::info('Admin login success', [
            'email' => $credentials['email'],
            'ip' => $request->ip(),
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
