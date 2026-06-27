<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\Security;

use Panda\WpMembersPay\Payments\Services\SecurityEventService;

final class TimestampValidator
{
    public function __construct(
        private readonly SecurityEventService $securityEventService,
    ) {
    }

    public function validate(
        int $timestamp,
        int $maxAgeSeconds = 300,
        ?string $referenceKey = null
    ): bool {
        $valid = abs(
            time() - $timestamp
        ) <= $maxAgeSeconds;

        if (! $valid) {
            $this->securityEventService->create(
                SecurityEventType::INVALID_TIMESTAMP,
                $_SERVER['REMOTE_ADDR'] ?? 'unknown',
                $referenceKey,
                wp_json_encode([
                    'timestamp' => $timestamp,
                ])
            );
        }

        return $valid;
    }
}
