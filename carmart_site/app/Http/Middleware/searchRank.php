<?php

namespace App\Http\Middleware;

use Closure;
use Lang;
use Illuminate\Support\Facades\DB;

class searchRank
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
        $keywords = DB::table('csearchrank')->orderBy('hits','desc')->get(['keyword']);
        if(!$request->session()->get('id')){
          return redirect()->route('loginP')->with('Alert', Lang::get('user_definition.yet_login') );
        }
        return $next($request);
    }
}
