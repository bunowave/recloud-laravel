<?php

namespace BunoWave\ReCloud\Http\Middleware;

use BunoWave\ReCloud\Client;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VerifyReCloud
{
    public function __construct(private Client $client)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        $result = $this->client->verify((string) $request->input('recloud-response'), $request->ip());

        if ($result->failed()) {
            throw ValidationException::withMessages(['recloud-response' => 'Verification failed. Please try again.']);
        }

        return $next($request);
    }
}
