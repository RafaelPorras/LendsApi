<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Traits\ApiResponser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
        AuthenticationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if($exception instanceof HttpException){
            $code = $exception->getStatusCode();
            $message = Response::$statusTexts[$code];
            return $this->errorResponse($message,$code);
        }

        if($exception instanceof ModelNotFoundException){
            $model = strtolower(class_basename($exception->getModel()));
            $code = Response::HTTP_NOT_FOUND;
            $message = 'Does not exist any instance of {$model} with the specified indentificator';
            return $this->errorResponse($message,$code);
        }

        if($exception instanceof AuthorizationException){
            $message = $exception->getMessage();
            $code = Response::HTTP_FORBIDDEN;
            return $this->errorResponse($message,$code);
        }

        if($exception instanceof AuthenticationException){
            $message = $exception->getMessage();
            $code = Response::HTTP_UNAUTHORIZED;
            return $this->errorResponse($message,$code);
        }

        if($exception instanceof ValidationException){
            $message = $exception->validator->errors()->getMessages();
            $code = Response::HTTP_UNPROCESSABLE_ENTITY;
            return $this->errorResponse($message,$code);
        }

        if(env('APP_DEBUG',false)){
            return parent::render($request, $exception);
        }

        //You may want to add a generic error response here for non-debug mode
        return $this->errorResponse('Unexpected error',Response::HTTP_INTERNAL_SERVER_ERROR);

       
    }
}
