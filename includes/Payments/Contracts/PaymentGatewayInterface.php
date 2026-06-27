<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\Contracts;

use Panda\WpMembersPay\Payments\DTO\PaymentRequestDto;
use Panda\WpMembersPay\Payments\DTO\PaymentResponseDto;

interface PaymentGatewayInterface
{
    public function createPayment(
        PaymentRequestDto $request
    ): PaymentResponseDto;

    public function verifyPayment(
        string $transactionId
    ): PaymentResponseDto;
}
