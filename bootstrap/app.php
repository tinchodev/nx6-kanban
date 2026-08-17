<?php

use GitScrum\Http\Middleware\GlobalActivities;
use GitScrum\Http\Middleware\IssueMiddleware;
use GitScrum\Http\Middleware\ProductbacklogMiddleware;
use GitScrum\Http\Middleware\RedirectIfAuthenticated;
use GitScrum\Http\Middleware\SprintExpired;
use GitScrum\Http\Middleware\UserAuthenticated;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'guest' => RedirectIfAuthenticated::class,
            'user.authenticated' => UserAuthenticated::class,
            'sprint.expired' => SprintExpired::class,
            'global.activities' => GlobalActivities::class,
            'issue' => IssueMiddleware::class,
            'product-backlog' => ProductbacklogMiddleware::class,
        ]);

        $middleware->api(prepend: [
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':60,1',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }

            return redirect()->guest('login');
        });
    })->create();
