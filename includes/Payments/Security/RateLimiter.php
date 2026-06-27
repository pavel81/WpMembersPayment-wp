<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\Security;

use Panda\WpMembersPay\Payments\Services\SecurityEventService;

final class RateLimiter
{
    /**
     * @var array<string,array<int>>
     */
    private array $requests = [];

    public function __construct(
        private readonly SecurityEventService $securityEventService,
    ) {
    }

    public function isAllowed(
        string $key,
        int $maxRequests = 50,
        int $windowSeconds = 300
    ): bool {
        $now = time();

        $this->cleanup(
            $key,
            $now,
            $windowSeconds
        );

        return count(
            $this->requests[$key] ?? []
        ) < $maxRequests;
    }

    public function recordRequest(
        string $key
    ): void {
        $this->requests[$key][] = time();
    }

    public function hit(
        string $key,
        int $maxRequests = 50,
        int $windowSeconds = 300
    ): bool {
        if (! $this->isAllowed(
            $key,
            $maxRequests,
            $windowSeconds
        )) {
            $this->securityEventService->create(
                SecurityEventType::RATE_LIMIT,
                $_SERVER['REMOTE_ADDR'] ?? 'unknown',
                $key,
                wp_json_encode([
                    'limit' => $maxRequests,
                    'window' => $windowSeconds,
                ])
            );

            return false;
        }

        $this->recordRequest(
            $key
        );

        return true;
    }

    private function cleanup(
        string $key,
        int $now,
        int $windowSeconds
    ): void {
        if (! isset($this->requests[$key])) {
            return;
        }

        $this->requests[$key] = array_filter(
            $this->requests[$key],
            static fn (int $timestamp): bool =>
                ($now - $timestamp) < $windowSeconds
        );
    }
}
