<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Retrieve the authenticated user or use a default value
        $user = $request->user();

        // Use the user's preferred locale if available, otherwise use a default
        $locale = $user->locale ? $user->locale->lang : 'fr';

        app()->setLocale($locale);

        return $next($request);
    }
}
