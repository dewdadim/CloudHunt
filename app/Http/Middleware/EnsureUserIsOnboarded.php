<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $user = $request->user();

        // Redirect guests to login
        if (!$user) {
            return redirect()->route('login');
        }

        // Check if any onboarding fields are missing
        $requiresOnboarding = !$user->full_name || !$user->username || !$user->date_of_birth || !$user->occupation || !$user->interest;

        // Redirect already onboarded users if they try to access the onboard route
        if (!$requiresOnboarding && $request->routeIs('onboard')) {
            return to_route('dashboard');
        }

        // Restrict access to other routes until onboarding is complete
        if ($requiresOnboarding && !$request->routeIs('onboard.index') && $request->isMethod('GET')) {
            return to_route('onboard.index');
        }

        return $next($request);
    }
}
