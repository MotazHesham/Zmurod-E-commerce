<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class ThrottleCartRequests
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
        
        if (RateLimiter::tooManyAttempts($key, $this->maxAttempts())) {
            return $this->buildResponse($key);
        }

        RateLimiter::hit($key, $this->decayMinutes() * 60);

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
            '|' . $request->user()->id ?? 'guest'
        );
    }

    /**
     * Create a 'too many attempts' response.
     *
     * @param  string  $key
     * @return \Illuminate\Http\JsonResponse
     */
    protected function buildResponse($key)
    {
        $retryAfter = $this->getTimeUntilNextAttempt($key);

        return response()->json([
            'message' => 'Too many cart operations. Please slow down.',
            'retry_after' => $retryAfter
        ], 429)->withHeaders([
            'Retry-After' => $retryAfter,
            'X-RateLimit-Reset' => $this->availableAt($key),
        ]);
    }

    /**
     * Add the limit header information to the given response.
     *
     * @param  \Illuminate\Http\Response  $response
     * @param  int  $maxAttempts
     * @param  int  $remainingAttempts
     * @return \Illuminate\Http\Response
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
        return RateLimiter::remaining($key, $this->maxAttempts());
    }

    /**
     * Get the number of seconds until the next retry.
     *
     * @param  string  $key
     * @return int
     */
    protected function getTimeUntilNextAttempt($key)
    {
        return RateLimiter::availableIn($key);
    }

    /**
     * Get the timestamp when the key will be available.
     *
     * @param  string  $key
     * @return int
     */
    protected function availableAt($key)
    {
        return RateLimiter::availableAt($key);
    }

    /**
     * Get the maximum number of attempts for the rate limiter.
     *
     * @return int
     */
    protected function maxAttempts()
    {
        return 30; // Allow more cart operations than auth
    }

    /**
     * Get the number of minutes to decay the rate limiter.
     *
     * @return int
     */
    protected function decayMinutes()
    {
        return 5; // Shorter decay time for cart operations
    }
}
