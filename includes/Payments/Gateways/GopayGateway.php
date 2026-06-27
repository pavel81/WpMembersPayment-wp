<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\Gateways;

use Panda\WpMembersPay\Payments\Contracts\PaymentGatewayInterface;
use Panda\WpMembersPay\Payments\DTO\PaymentRequestDto;
use Panda\WpMembersPay\Payments\DTO\PaymentResponseDto;

final class GoPayGateway implements PaymentGatewayInterface
{
    public function createPayment(
        PaymentRequestDto $request
    ): PaymentResponseDto {
        throw new \RuntimeException(
            'GoPay gateway not implemented.'
        );
    }

    public function verifyPayment(
        string $transactionId
    ): PaymentResponseDto {
        throw new \RuntimeException(
            'GoPay gateway not implemented.'
        );
    }
}
