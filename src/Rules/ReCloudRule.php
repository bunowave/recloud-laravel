<?php

namespace BunoWave\ReCloud\Rules;

use BunoWave\ReCloud\Client;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ReCloudRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $token = is_string($value) ? $value : '';

        if (app(Client::class)->verify($token, request()->ip())->failed()) {
            $fail('Verification failed. Please try again.');
        }
    }
}
