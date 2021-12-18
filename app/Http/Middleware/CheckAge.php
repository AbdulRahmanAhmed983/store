<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;


class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //logic middleware
        $age = Auth::user()->Age; 
        if($age < 15){
            return redirect()->route('notadualt');
        }
        return $next($request);
    }
}
