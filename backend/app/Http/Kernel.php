<?php

namespace App\Http;

use App\Http\Middleware\CORS;
use App\Http\Middleware\Driver;
use App\Http\Middleware\Worker;
use App\Http\Middleware\Customer;
use App\Http\Middleware\Visitors;
use App\Http\Middleware\Restaurant;
use App\Http\Middleware\ForceLogOut;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\TrustProxies;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\RestaurantLive;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\isLeadSubmitted;
use App\Http\Middleware\LanguageManager;
use App\Http\Middleware\LocalizationApi;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Middleware\CheckPermissions;
use Illuminate\Auth\Middleware\Authorize;
use App\Http\Middleware\RestaurantNotLive;
use App\Http\Middleware\RestaurantSubLive;
use App\Http\Middleware\ValidateSignature;
use Illuminate\Http\Middleware\HandleCors;
use App\Http\Middleware\isLeadNotSubmitted;
use App\Http\Middleware\RestaurantOrWorker;
use Illuminate\Console\Scheduling\Schedule;
use App\Http\Middleware\EnsurePhoneVerified;
use App\Http\Middleware\IsBusinessSubmitted;
use App\Http\Middleware\EnsureEmailIsVerified;
use App\Http\Middleware\EnsurePhoneNotVerified;
use App\Http\Middleware\EnsureUserIsNotBlocked;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Session\Middleware\StartSession;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\EnsureEmailIsNotVerified;
use App\Http\Middleware\IsBusinessFilesSubmitted;
use App\Http\Middleware\RedirectIfNotBelongToBranch;
use Spatie\Permission\Middlewares\RoleMiddleware;
use App\Http\Middleware\ActiveRestaurantAndBranch;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Http\Middleware\PreventRequestsDuringMaintenance;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use App\Http\Middleware\EnsureTraderRegistrationIsComplete;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use App\Http\Middleware\EnsureTraderRegistrationIsNotComplete;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */

     protected function schedule(Schedule $schedule)
    {
        $schedule->command('auth:clear-resets')->everyFifteenMinutes();
    }



    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        CORS::class,
        TrustProxies::class,
        HandleCors::class,
        PreventRequestsDuringMaintenance::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            SubstituteBindings::class,
            LanguageManager::class,
            ForceLogOut::class
        ],

        'api' => [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            ThrottleRequests::class.':api',
            SubstituteBindings::class,


        ],
        'tenant' => [
            InitializeTenancyByDomainOrSubdomain::class,
            PreventAccessFromCentralDomains::class,
        ],

        'universal' => [],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'admin' => AdminMiddleware::class,
        'restaurant' => Restaurant::class,
        'worker' => Worker::class,
        'driver' => Driver::class,
        'customer' => Customer::class,
        'restaurantOrWorker' => RestaurantOrWorker::class,
        'restaurantLive' => RestaurantLive::class,
        'restaurantSubLive' => RestaurantSubLive::class,
        'restaurantNotLive' => RestaurantNotLive::class,
        'permission' => CheckPermissions::class,
        'auth' => Authenticate::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'auth.session' => AuthenticateSession::class,
        'cache.headers' => SetCacheHeaders::class,
        'can' => Authorize::class,
        'guest' => RedirectIfAuthenticated::class,
        'password.confirm' => RequirePassword::class,
        'signed' => ValidateSignature::class,
        'throttle' => ThrottleRequests::class,
        'verified' => EnsureEmailIsVerified::class,
        'notVerified' => EnsureEmailIsNotVerified::class,
        'verifiedPhone' => EnsurePhoneVerified::class,
        'notVerifiedPhone' => EnsurePhoneNotVerified::class,
        'accepted' => EnsureTraderRegistrationIsComplete::class,
        'notAccepted'=> EnsureTraderRegistrationIsNotComplete::class,
        'notBlocked'=> EnsureUserIsNotBlocked::class,
        'role' => RoleMiddleware::class,
        'isBusinessFilesSubmitted'=>IsBusinessFilesSubmitted::class,
        'isLeadSubmitted'=>isLeadSubmitted::class,
        // 'isLeadNotSubmitted'=>isLeadNotSubmitted::class,
        'isBusinessSubmitted'=>IsBusinessSubmitted::class,
        "trans_api"=>LocalizationApi::class,
        'ActiveRestaurantAndBranch'=>ActiveRestaurantAndBranch::class,
        'visitors'=> Visitors::class,
        'redirectIfNotBelongToBranch'=>RedirectIfNotBelongToBranch::class
    ];

}
