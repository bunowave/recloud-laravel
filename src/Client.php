<?php

namespace BunoWave\ReCloud;

use Illuminate\Support\Facades\Http;

class Client
{
    public function __construct(private array $config)
    {
    }

    public function verify(?string $token, ?string $remoteIp = null): Result
    {
        $token = trim((string) $token);
        if ($token === '') {
            return new Result(false, ['missing-input']);
        }

        $secret = (string) ($this->config['secret'] ?? '');
        if ($secret === '') {
            throw new \InvalidArgumentException('RECLOUD_SECRET is not configured.');
        }

        $payload = ['secret' => $secret, 'response' => $token];
        if (($this->config['send_ip'] ?? false) && $remoteIp) {
            $payload['remoteip'] = $remoteIp;
        }

        try {
            $response = Http::asForm()
                ->acceptJson()
                ->timeout((int) ($this->config['timeout'] ?? 10))
                ->post(rtrim((string) $this->config['url'], '/').'/api/v1/siteverify', $payload);
            $data = $response->json();
        } catch (\Throwable $e) {
            return $this->unavailable('network-error');
        }

        if (! $response->successful() || ! is_array($data)) {
            return $this->unavailable('bad-response');
        }

        return new Result(
            ($data['success'] ?? false) === true,
            (array) ($data['error-codes'] ?? []),
            $data['hostname'] ?? null,
            isset($data['risk']) ? (int) $data['risk'] : null,
            $data['challenge_ts'] ?? null,
        );
    }

    private function unavailable(string $code): Result
    {
        $open = (bool) ($this->config['fail_open'] ?? false);

        return new Result($open, [$code], null, null, null, $open);
    }
}
