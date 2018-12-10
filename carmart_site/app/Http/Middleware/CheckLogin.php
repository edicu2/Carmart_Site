<?php

namespace App\Http\Middleware;

use Closure;
use Lang;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->session()->get('id')){
          return redirect()->route('loginP')->with('Alert', Lang::get('user_definition.yet_login') );
        }
        return $next($request);
    }
}
