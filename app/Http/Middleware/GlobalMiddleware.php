<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
class GlobalMiddleware extends BaseMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard != null) {
            auth()->shouldUse($guard);
            $token = request()->header('auth_token');
            request()->headers->set('auth_token', (string) $token, true);
            request()->headers->set('Authorization', 'Bearer' . $token, true);



            try {
                $user = JWTAuth::parseToken()->authenticate();
            } catch (\Exception $e) {
                return response()->json([
                    'state' => 'error',
                    'msg' => 'your token is not valid'
                ]);
            }
        } //end of if
        return $next($request);
    } //end of handle middleware
}
