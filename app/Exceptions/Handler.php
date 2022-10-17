<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use App\Helpers\Functions;
use Spatie\Permission\Exceptions\UnauthorizedException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
        

        $this->renderable(function(TokenInvalidException $e, $request){
            return Functions::sendError('Invalid Token', [], 401);
        });
        $this->renderable(function (TokenExpiredException $e, $request) {
            return Functions::sendError('Token has Expired', [], 401);
        });
        $this->renderable(function (TokenBlacklistedException $e, $request) {
            return Functions::sendError('Token has been blacklisted', [], 401);
        });
        $this->renderable(function (JWTException $e, $request) {
        
            return Functions::sendError('Token not parsed', [], 401);
        });
    
        $this->renderable(function (UnauthorizedException $e, $request) {
            return Functions::sendError('You do not have the required authorization.', [], 401);
        });
    }
}
