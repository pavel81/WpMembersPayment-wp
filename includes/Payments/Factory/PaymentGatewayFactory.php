<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\Factory;

use InvalidArgumentException;
use Panda\WpMembersPay\Payments\Contracts\PaymentGatewayInterface;
use Panda\WpMembersPay\Payments\Gateways\ComgateGateway;
use Panda\WpMembersPay\Payments\Gateways\GoPayGateway;
use Panda\WpMembersPay\Payments\Gateways\StripeGateway;

final class PaymentGatewayFactory
{
    public function create(
        string $gateway
    ): PaymentGatewayInterface {
        $gateways = $this->getAvailableGateways();

        if (
            ! isset($gateways[$gateway])
            || ! is_string($gateways[$gateway])
        ) {
            throw new InvalidArgumentException(
                sprintf(
                    'Unsupported payment gateway "%s".',
                    $gateway
                )
            );
        }

        $gatewayClass = $gateways[$gateway];

        $instance = new $gatewayClass();

        if (! $instance instanceof PaymentGatewayInterface) {
            throw new InvalidArgumentException(
                sprintf(
                    'Gateway "%s" must implement PaymentGatewayInterface.',
                    $gateway
                )
            );
        }

        return $instance;
    }

    /**
     * @return array<string,class-string<PaymentGatewayInterface>>
     */
    public function getAvailableGateways(): array
    {
        return apply_filters(
            'pwmp_payment_gateways',
            [
                'stripe'  => StripeGateway::class,
                'comgate' => ComgateGateway::class,
                'gopay'   => GoPayGateway::class,
            ]
        );
    }
}
