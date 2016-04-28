<?php

namespace Furbook\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class IsAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(! Auth::guard($guard)->user()->isAdministrator()){
            if($request->ajax() || $request->wantsJson()){
                return response('Unauthorized.', 401);
            }else{
                throw new AccessDeniedHttpException();
            }
        }
        return $next($request);
    }
}
