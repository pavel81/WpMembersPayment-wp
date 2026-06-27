<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\Configuration;

use Panda\WpMembersPay\Payments\Contracts\GatewayConfigurationInterface;

final class WordPressGatewayConfiguration implements GatewayConfigurationInterface
{
    private const OPTION_PREFIX =
        'pwmp_gateway_';

    public function get(
        string $gateway,
        string $key,
        mixed $default = null
    ): mixed {
        $config = $this->getGatewayConfiguration(
            $gateway
        );

        return $config[$key]
            ?? $default;
    }

    public function has(
        string $gateway,
        string $key
    ): bool {
        $config = $this->getGatewayConfiguration(
            $gateway
        );

        return array_key_exists(
            $key,
            $config
        );
    }

    /**
     * @return array<string,mixed>
     */
    public function getGatewayConfiguration(
        string $gateway
    ): array {
        $config = get_option(
            self::OPTION_PREFIX . $gateway,
            []
        );

        return is_array($config)
            ? $config
            : [];
    }

    public function getConfig(
        string $gateway
    ): PaymentGatewayConfig {
        $config = $this->getGatewayConfiguration(
            $gateway
        );

        return new PaymentGatewayConfig(
            gateway: $gateway,
            enabled: (bool) ($config['enabled'] ?? false),
            sandbox: (bool) ($config['sandbox'] ?? true),
            merchantId: $config['merchant_id'] ?? null,
            publicKey: $config['public_key'] ?? null,
            secretKey: $config['secret_key'] ?? null,
            webhookSecret: $config['webhook_secret'] ?? null,
            timeout: (int) ($config['timeout'] ?? 30),
            currency: (string) ($config['currency'] ?? 'CZK'),
            options: is_array($config['options'] ?? null)
                ? $config['options']
                : [],
        );
    }
}
