<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
      'password',
      'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
      if ($this->isHttpException($exception)) {
        $message = $exception->getMessage();
        switch ($exception->getStatusCode()) {
          // not authorized
          case '403':
            return api_response_error('You are not allowed to access this', 403);
          break;

          // not found
          case '404':
            return api_response_error('Resource not found', 404);
          break;

          // method not allowed
          case '405':
            return api_response_error($message, 405);
          break;

          // internal error
          case '500':
            $message = 'Something went terribly wrong: ' . $message;
            return api_response_error($message, 500);
          break;

          default:
            return api_response_error($message, 400);
          break;
        }
      }

      return parent::render($request, $exception);
    }
  }
