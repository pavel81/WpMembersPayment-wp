<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\Security;

use Panda\WpMembersPay\Payments\Services\SecurityEventService;

final class SignatureValidator
{
    public function __construct(
        private readonly SecurityEventService $securityEventService,
    ) {
    }

    public function validate(
        string $payload,
        string $signature,
        string $secret,
        ?string $referenceKey = null
    ): bool {
        $calculatedSignature = hash_hmac(
            'sha256',
            $payload,
            $secret
        );

        $valid = hash_equals(
            $calculatedSignature,
            $signature
        );

        if (! $valid) {
            $this->securityEventService->create(
                SecurityEventType::INVALID_SIGNATURE,
                $_SERVER['REMOTE_ADDR'] ?? 'unknown',
                $referenceKey,
                wp_json_encode([
                    'reason' => 'signature_mismatch',
                ])
            );
        }

        return $valid;
    }
}
