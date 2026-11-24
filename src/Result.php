<?php

namespace BunoWave\ReCloud;

class Result
{
    public function __construct(
        public readonly bool $success,
        public readonly array $errorCodes = [],
        public readonly ?string $hostname = null,
        public readonly ?int $risk = null,
        public readonly ?string $challengeTs = null,
        public readonly bool $degraded = false,
    ) {
    }

    public function passed(): bool
    {
        return $this->success;
    }

    public function failed(): bool
    {
        return ! $this->success;
    }
}
