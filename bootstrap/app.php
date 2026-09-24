<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ApiKeyAuth;
use App\Http\Middleware\SecurityHeaders;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
        ]);
        // Every /api route needs a key — runs first so unauthenticated callers can't probe record IDs
        $middleware->api(prepend: [ApiKeyAuth::class]);
        $middleware->redirectGuestsTo(fn() => route('admin.login'));
        $middleware->append(SecurityHeaders::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // API callers always get JSON errors (404, 422 ...), never an HTML page
        $exceptions->shouldRenderJsonWhen(fn($request) => $request->is('api/*') || $request->expectsJson());

        // Short, clean API errors — no model names / file paths / stack traces even when APP_DEBUG is on
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json(['success' => false, 'message' => 'Record or endpoint not found.'], 404);
            }
        });
        $exceptions->render(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json(['success' => false, 'message' => 'This API is read-only. Only GET requests are allowed.'], 405);
            }
        });
    })->create();
