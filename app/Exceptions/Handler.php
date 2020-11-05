<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        // this check for requests with the header Application:application/json
        // also handles for null results returned
        // echo $exception;
        
        if ($exception instanceof ModelNotFoundException &&
             $request->wantsJson()) 
        {
            if($request->path() == "api/login"){
                return  response() -> json(["message" => "The specified user not found"], 401);
            }
            return response()->json(["message" =>"Grant not found"], 404);
            
        } else {
            return parent::render($request, $exception);
        }
    }

}