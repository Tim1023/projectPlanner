<?php

namespace ProgramPlanner\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use ProgramPlanner\Http\Middleware\Admin;
use ProgramPlanner\Http\Middleware\Authenticate;
use ProgramPlanner\Http\Middleware\EncryptCookies;
use ProgramPlanner\Http\Middleware\RedirectIfAuthenticated;
use ProgramPlanner\Http\Middleware\VerifyCsrfToken;


class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        CheckForMaintenanceMode::class,
        EncryptCookies::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        ShareErrorsFromSession::class,
        VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'guest' => RedirectIfAuthenticated::class,
        'admin' => Admin::class,
    ];
}