<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AllowYouTubeEmbeds
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Remove CSP headers completely for video pages to allow YouTube
        $response->headers->remove('Content-Security-Policy');
        $response->headers->remove('X-Content-Security-Policy');
        $response->headers->remove('X-WebKit-CSP');
        
        // Only set X-Frame-Options to allow same origin
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        
        return $response;
    }
}
