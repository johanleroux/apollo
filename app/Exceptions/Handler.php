<?php

namespace App\Exceptions;

use Exception;
use App\Traits\RestTrait;
use App\Traits\RestExceptionHandlerTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use RestTrait;
    use RestExceptionHandlerTrait;

    /**
    * A list of the exception types that should not be reported.
    *
    * @var array
    */
    protected $dontReport = [
    \Illuminate\Auth\AuthenticationException::class,
    \Illuminate\Auth\Access\AuthorizationException::class,
    \Symfony\Component\HttpKernel\Exception\HttpException::class,
    \Illuminate\Database\Eloquent\ModelNotFoundException::class,
    \Illuminate\Session\TokenMismatchException::class,
    \Illuminate\Validation\ValidationException::class,
    ];

    /**
    * Report or log an exception.
    *
    * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
    *
    * @param  \Exception  $exception
    * @return void
    */
    public function report(Exception $exception)
    {
        // if ($exception instanceof \Illuminate\Validation\ValidationException) {
        //     \Illuminate\Support\Facades\Log::info(
        //         $exception->validator->errors()
        //     );
        // }

        parent::report($exception);
    }

    /**
    * Render an exception into an HTTP response.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Exception  $exception
    * @return \Illuminate\Http\Response
    */
    public function render($request, Exception $e)
    {
        if ($e instanceof Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } elseif ($e instanceof Tymon\JWTAuth\Exceptions\TokenInvalidException) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        }
        if (!$this->isApiCall($request)) {
            return parent::render($request, $e);
        }

        return $this->getJsonResponseForException($request, $e);
    }

    /**
    * Convert an authentication exception into an unauthenticated response.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Illuminate\Auth\AuthenticationException  $exception
    * @return \Illuminate\Http\Response
    */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
