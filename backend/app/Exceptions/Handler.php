<?php

namespace App\Exceptions;

use Sentry\Laravel\Integration;
use Throwable;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Stancl\Tenancy\Contracts\TenantCouldNotBeIdentifiedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Stancl\Tenancy\Exceptions\DomainOccupiedByOtherTenantException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            Integration::captureUnhandledException($e);
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof TokenMismatchException) {
            $newToken = csrf_token();

            return redirect()->back()->withInput()->with(['_token' => $newToken]);
        }

         if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
            if ($request->expectsJson()) {
                return response()->json(['error' => __("Not found")], 404);
            }
            return  redirect()->back();
        }
        if ($exception instanceof TenantCouldNotBeIdentifiedException || $exception instanceof DomainOccupiedByOtherTenantException) {
            return redirect()->route('home');
        }

        return parent::render($request, $exception);
    }
}
