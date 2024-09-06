<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable|Exception $e) {
            //
        });

        $this->renderable(function (Throwable|Exception $e) {
            //
            if($e instanceof RouteNotFoundException){
                return response()->json([
                    'status' => false,
                    'message' => 'Login first'
                ]);
            }
            else
             if($e instanceof QueryException){
               return response()->json([
                  'status' => false,
                  'message' => 'Check Db Connection Or State'
               ]);
            }
            else
             if($e instanceof NotFoundHttpException){
                return response()->json([
                   'status' => false,
                   'message' => 'NotFoundHttpException'
                ]);
            }
        });
    }
}
