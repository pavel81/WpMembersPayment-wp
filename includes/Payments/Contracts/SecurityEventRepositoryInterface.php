<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\Contracts;

use Panda\WpMembersPay\Payments\DTO\SecurityEventDto;

interface SecurityEventRepositoryInterface
{
    public function findById(
        int $id
    ): ?SecurityEventDto;

    /**
     * @return SecurityEventDto[]
     */
    public function findAll(): array;

    /**
     * @return SecurityEventDto[]
     */
    public function findByEventType(
        string $eventType
    ): array;

    /**
     * @return SecurityEventDto[]
     */
    public function findByReferenceKey(
        string $referenceKey
    ): array;

    public function save(
        SecurityEventDto $event
    ): int;

    public function delete(
        int $id
    ): bool;
}
