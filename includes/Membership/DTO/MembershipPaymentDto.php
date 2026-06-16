<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\DTO;

final readonly class MembershipPaymentDto
{
    public function __construct(
        public ?int $id,
        public int $membershipId,
        public string $paymentGateway,
        public string $transactionId,
        public float $amount,
        public string $currency,
        public string $status,
        public ?string $gatewayPayload = null,
        public ?string $paidAt = null,
    ) {
    }
}
