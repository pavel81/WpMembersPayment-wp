<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\Configuration;

final readonly class PaymentGatewayConfig
{
    /**
     * @param array<string,mixed> $options
     */
    public function __construct(
        public string $gateway,
        public bool $enabled,
        public bool $sandbox,
        public ?string $merchantId = null,
        public ?string $publicKey = null,
        public ?string $secretKey = null,
        public ?string $webhookSecret = null,
        public int $timeout = 30,
        public string $currency = 'CZK',
        public array $options = [],
    ) {
    }
}
