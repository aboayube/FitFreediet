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
    public function handle(Request $request, Closure $next,$guards=null)
    {

$premasion=[
    1=>'user',
    2=>'admin',
    3=>'admin'
];
if(Auth::guard($guards)->check()){

    if(Auth::user()->role=='admin' || Auth::user()->role=='docotor'){
        return redirect()->route('admin');
    }else{
        return redirect()->route('user');
    }

}
        return $next($request);
    }
}
