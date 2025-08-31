<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter as FacadesRateLimiter;
use Symfony\Component\HttpFoundation\Response;

class ThrottleAuthRequests
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
        $key = $this->resolveRequestSignature($request);
        
        if (FacadesRateLimiter::tooManyAttempts($key, $this->maxAttempts())) {
            return $this->buildResponse($key);
        }

        FacadesRateLimiter::hit($key, $this->decayMinutes() * 60);

        $response = $next($request);

        return $this->addHeaders(
            $response, $this->maxAttempts(),
            $this->calculateRemainingAttempts($key)
        );
    }

    /**
     * Resolve request signature.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function resolveRequestSignature($request)
    {
        return sha1(
            $request->method() .
            '|' . $request->server('SERVER_NAME') .
            '|' . $request->ip() .
            '|' . $request->input('email', '')
        );
    }

    /**
     * Create a 'too many attempts' response.
     *
     * @param  string  $key
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function buildResponse($key)
    {
        $retryAfter = $this->getTimeUntilNextAttempt($key);

        return response()->json([
            'message' => 'Too many login attempts. Please try again later.',
            'retry_after' => $retryAfter
        ], 429)->withHeaders([
            'Retry-After' => $retryAfter,
            'X-RateLimit-Reset' => $this->availableAt($key),
        ]);
    }

    /**
     * Add the limit header information to the given response.
     *
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @param  int  $maxAttempts
     * @param  int  $remainingAttempts
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function addHeaders($response, $maxAttempts, $remainingAttempts)
    {
        return $response->withHeaders([
            'X-RateLimit-Limit' => $maxAttempts,
            'X-RateLimit-Remaining' => $remainingAttempts,
        ]);
    }

    /**
     * Calculate the number of remaining attempts.
     *
     * @param  string  $key
     * @return int
     */
    protected function calculateRemainingAttempts($key)
    {
        return FacadesRateLimiter::remaining($key, $this->maxAttempts());
    }

    /**
     * Get the number of seconds until the next retry.
     *
     * @param  string  $key
     * @return int
     */
    protected function getTimeUntilNextAttempt($key)
    {
        return FacadesRateLimiter::availableIn($key);
    }

    /**
     * Get the timestamp when the key will be available.
     *
     * @param  string  $key
     * @return int
     */
    protected function availableAt($key)
    {
        return FacadesRateLimiter::availableAt($key);
    }

    /**
     * Get the maximum number of attempts for the rate limiter.
     *
     * @return int
     */
    protected function maxAttempts()
    {
        return 5;
    }

    /**
     * Get the number of minutes to decay the rate limiter.
     *
     * @return int
     */
    protected function decayMinutes()
    {
        return 15;
    }
}
