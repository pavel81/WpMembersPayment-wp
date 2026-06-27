<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\Contracts;

use Panda\WpMembersPay\Payments\Configuration\PaymentGatewayConfig;

interface GatewayConfigurationInterface
{
    /**
     * Returns a single configuration value.
     */
    public function get(
        string $gateway,
        string $key,
        mixed $default = null
    ): mixed;

    /**
     * Determines whether the specified configuration key exists.
     */
    public function has(
        string $gateway,
        string $key
    ): bool;

    /**
     * Returns the complete configuration as an associative array.
     *
     * @return array<string,mixed>
     */
    public function getGatewayConfiguration(
        string $gateway
    ): array;

    /**
     * Returns the configuration as a strongly typed object.
     */
    public function getConfig(
        string $gateway
    ): PaymentGatewayConfig;
}
