<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Api\Webhooks;

final class WebhookSecretManager
{
    private const OPTION_PREFIX =
        'pwmp_webhook_secret_';

    public function getSecret(
        string $gateway
    ): ?string {
        $secret = get_option(
            self::OPTION_PREFIX . $gateway
        );

        if (! is_string($secret)) {
            return null;
        }

        return $secret;
    }

    public function saveSecret(
        string $gateway,
        string $secret
    ): bool {
        return update_option(
            self::OPTION_PREFIX . $gateway,
            $secret,
            false
        );
    }

    public function deleteSecret(
        string $gateway
    ): bool {
        return delete_option(
            self::OPTION_PREFIX . $gateway
        );
    }

    public function hasSecret(
        string $gateway
    ): bool {
        $secret = $this->getSecret(
            $gateway
        );

        return $secret !== null
            && $secret !== '';
    }

    public function generateSecret(
        int $length = 64
    ): string {
        return bin2hex(
            random_bytes(
                (int) ceil($length / 2)
            )
        );
    }

    public function rotateSecret(
        string $gateway
    ): string {
        $secret = $this->generateSecret();

        $this->saveSecret(
            $gateway,
            $secret
        );

        return $secret;
    }
}
