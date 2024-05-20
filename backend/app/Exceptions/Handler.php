<?php

namespace App\Exceptions;

use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Sentry\Laravel\Integration;
use Stancl\Tenancy\Exceptions\TenantCouldNotBeIdentifiedOnDomainException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
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

    public function report(Throwable $exception)
    {
        // Exclude Exceptions
        if ($exception instanceof TenantCouldNotBeIdentifiedOnDomainException ||
            $exception instanceof NotFoundHttpException || $exception instanceof MethodNotAllowedHttpException) {
            return;
        }

        if (app()->bound('sentry')) {
            app('sentry')->captureException($exception);
//            Integration::captureUnhandledException($exception);
        }
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {

        $this->reportable(function (Throwable $e) {
            //
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
            return redirect()->route('restaurant_not_found');
        }
        if($exception instanceof ThrottleRequestsException) {
            return parent::render(
                $request, new ThrottleRequestsException(
                    __('Too many attempts, please try again later.'),
                    $exception->getPrevious(),
                    $exception->getHeaders(),
                    $exception->getCode()
                )
            );
        }

        return parent::render($request, $exception);
    }
}
