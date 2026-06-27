<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\DTO;

final readonly class PaymentRequestDto
{
    /**
     * @param array<string,mixed> $metadata
     */
    public function __construct(
        public string $gateway,
        public int $membershipId,
        public int $userId,
        public float $amount,
        public string $currency,
        public string $description,
        public string $returnUrl,
        public string $cancelUrl,
        public string $callbackUrl,
        public ?string $customerEmail = null,
        public ?string $customerName = null,
        public ?string $customerId = null,
        public ?string $externalReference = null,
        public ?string $locale = null,
        public array $metadata = [],
    ) {
    }
}
