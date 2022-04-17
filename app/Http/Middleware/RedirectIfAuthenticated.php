<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
      //  $veio = $request;
        
     //   dd('aqui',$_REQUEST,$request, $_SERVER['PATH_INFO'],$guards,$next,empty($guards));
        
        $guards = empty($guards) ? [null] : $guards;

     //   dd('aqui',$_REQUEST,$request, $_SERVER['PATH_INFO'],$guards,$next,empty($guards));

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                dd($guard);
                return redirect(RouteServiceProvider::HOME);
             
            }
        }
     dd($guards,'passou',$next,$request,$next($request));

     // return view('plantetc.dashboards.dashboard');

       return $next($request);
    }
}
