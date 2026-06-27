<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\Security;

use Panda\WpMembersPay\Payments\Services\SecurityEventService;
use Panda\WpMembersPay\Payments\Security\SecurityEventType;

final class PayloadValidator
{
    public function __construct(
        private readonly SecurityEventService $securityEventService,
    ) {
    }

    public function validateSize(
        string $payload,
        int $maxBytes = 262144
    ): bool {
        return strlen(
            $payload
        ) <= $maxBytes;
    }

    public function isValidJson(
        string $payload
    ): bool {
        if ($payload === '') {
            return false;
        }

        json_decode(
            $payload,
            true
        );

        return json_last_error()
            === JSON_ERROR_NONE;
    }

    /**
     * @param string[] $requiredFields
     */
    public function hasRequiredFields(
        string $payload,
        array $requiredFields
    ): bool {
        $data = json_decode(
            $payload,
            true
        );

        if (! is_array($data)) {
            return false;
        }

        foreach ($requiredFields as $field) {
            if (! array_key_exists(
                $field,
                $data
            )) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string[] $requiredFields
     */
    public function validate(
        string $payload,
        array $requiredFields = [],
        int $maxBytes = 262144
    ): bool {
        if (! $this->validateSize(
            $payload,
            $maxBytes
        )) {
            $this->logInvalidPayload(
                $payload
            );

            return false;
        }

        if (! $this->isValidJson(
            $payload
        )) {
            $this->logInvalidPayload(
                $payload
            );

            return false;
        }

        if (
            $requiredFields !== []
            && ! $this->hasRequiredFields(
                $payload,
                $requiredFields
            )
        ) {
            $this->logInvalidPayload(
                $payload
            );

            return false;
        }

        return true;
    }

    private function logInvalidPayload(
        string $payload
    ): void {
        $this->securityEventService->create(
            SecurityEventType::INVALID_PAYLOAD,
            $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            null,
            $payload
        );
    }
}
