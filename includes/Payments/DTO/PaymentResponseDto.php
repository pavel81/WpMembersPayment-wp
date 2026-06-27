<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\DTO;

final readonly class PaymentResponseDto
{
    /**
     * @param array<string,mixed> $gatewayData
     * @param array<string,mixed> $rawResponse
     */
    public function __construct(
        public bool $success,
        public string $gateway,
        public string $transactionId,
        public string $status,
        public ?string $redirectUrl = null,
        public ?string $message = null,
        public ?string $paidAt = null,
        public array $gatewayData = [],
        public array $rawResponse = [],
    ) {
    }
}
