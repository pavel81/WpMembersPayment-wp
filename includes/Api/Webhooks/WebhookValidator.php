<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Api\Webhooks;

use Panda\WpMembersPay\Payments\Security\PayloadValidator;
use Panda\WpMembersPay\Payments\Security\ReplayProtection;
use Panda\WpMembersPay\Payments\Security\SignatureValidator;
use Panda\WpMembersPay\Payments\Security\TimestampValidator;

final class WebhookValidator
{
    public function __construct(
        private readonly SignatureValidator $signatureValidator,
        private readonly TimestampValidator $timestampValidator,
        private readonly ReplayProtection $replayProtection,
        private readonly PayloadValidator $payloadValidator,
    ) {
    }

    /**
     * @param string[] $requiredFields
     */
    public function validate(
        string $payload,
        string $signature,
        string $secret,
        int $timestamp,
        string $eventId,
        array $requiredFields = []
    ): bool {
        if (! $this->payloadValidator->validate(
            $payload,
            $requiredFields
        )) {
            return false;
        }

        if (! $this->timestampValidator->validate(
            $timestamp,
            300,
            $eventId
        )) {
            return false;
        }

        if (! $this->signatureValidator->validate(
            $payload,
            $signature,
            $secret,
            $eventId
        )) {
            return false;
        }

        if ($this->replayProtection->isProcessed(
            $eventId
        )) {
            return false;
        }

        $this->replayProtection->markProcessed(
            $eventId
        );

        return true;
    }
}
