<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Api\Webhooks;

use InvalidArgumentException;

final class WebhookRouter
{
    /**
     * @var array<string,callable>
     */
    private array $handlers = [];

    public function register(
        string $gateway,
        callable $handler
    ): void {
        $this->handlers[$gateway] = $handler;
    }

    /**
     * @param array<string,mixed> $payload
     */
    public function dispatch(
        string $gateway,
        array $payload
    ): mixed {
        if (! isset(
            $this->handlers[$gateway]
        )) {
            throw new InvalidArgumentException(
                sprintf(
                    'Webhook handler for gateway "%s" is not registered.',
                    $gateway
                )
            );
        }

        return call_user_func(
            $this->handlers[$gateway],
            $payload
        );
    }

    public function hasHandler(
        string $gateway
    ): bool {
        return isset(
            $this->handlers[$gateway]
        );
    }

    /**
     * @return string[]
     */
    public function getRegisteredGateways(): array
    {
        return array_keys(
            $this->handlers
        );
    }
}
