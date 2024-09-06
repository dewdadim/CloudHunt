<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsOnboarded
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            is_null($request->user()->full_name) || 
            is_null($request->user()->username) || 
            is_null($request->user()->date_of_birth) || 
            is_null($request->user()->occupation) || 
            is_null($request->user()->interest)
        ) {
            return redirect()->route('onboard');
        }

        // if($request->user()->full_name != null) {
        //     return redirect()->route('home');
        // } 

        return $next($request);
    }
}
