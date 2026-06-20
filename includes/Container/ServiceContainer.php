<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Container;
use RuntimeException;

final class ServiceContainer
{
    /**
     * @var array<string,mixed>
     */
    private array $services = [];

    public function set(
        string $id,
        mixed $service
    ): void {
        $this->services[$id] = $service;
    }

public function get(
    string $id
): mixed {
    if (! isset($this->services[$id])) {
        throw new RuntimeException(
            sprintf(
                'Service "%s" not found.',
                $id
            )
        );
    }

    return $this->services[$id];
}

    public function has(
        string $id
    ): bool {
        return isset($this->services[$id]);
    }
}
