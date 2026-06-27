<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\Services;

use Panda\WpMembersPay\Payments\DTO\PaymentRequestDto;
use Panda\WpMembersPay\Payments\DTO\PaymentResponseDto;
use Panda\WpMembersPay\Payments\Factory\PaymentGatewayFactory;

final class PaymentProcessor
{
    public function __construct(
        private readonly PaymentGatewayFactory $factory,
    ) {
    }

    public function createPayment(
    PaymentRequestDto $request
): PaymentResponseDto
{
    return $this->factory
        ->create($request->gateway)
        ->createPayment($request);
}

    public function verifyPayment(
        string $gateway,
        string $transactionId
    ): PaymentResponseDto {
        return $this->factory
            ->create($gateway)
            ->verifyPayment($transactionId);
    }
}
