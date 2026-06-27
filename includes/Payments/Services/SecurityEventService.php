<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\Services;

use Panda\WpMembersPay\Payments\Contracts\SecurityEventRepositoryInterface;
use Panda\WpMembersPay\Payments\DTO\SecurityEventDto;
use Panda\WpMembersPay\Payments\Security\SecurityEventType;

final class SecurityEventService
{
    public function __construct(
        private readonly SecurityEventRepositoryInterface $repository
    ) {
    }

    public function findById(
        int $id
    ): ?SecurityEventDto {
        return $this->repository->findById(
            $id
        );
    }

    /**
     * @return SecurityEventDto[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @return SecurityEventDto[]
     */
    public function findByEventType(
        string $eventType
    ): array {
        return $this->repository->findByEventType(
            $eventType
        );
    }

    /**
     * @return SecurityEventDto[]
     */
    public function findByReferenceKey(
        string $referenceKey
    ): array {
        return $this->repository->findByReferenceKey(
            $referenceKey
        );
    }

    public function create(
        string $eventType,
        string $ipAddress,
        ?string $referenceKey = null,
        ?string $payload = null
    ): int {
        return $this->repository->save(
            new SecurityEventDto(
                id: null,
                eventType: $eventType,
                ipAddress: $ipAddress,
                referenceKey: $referenceKey,
                payload: $payload,
                createdAt: null,
            )
        );
    }

    public function save(
        SecurityEventDto $event
    ): int {
        return $this->repository->save(
            $event
        );
    }

    public function delete(
        int $id
    ): bool {
        return $this->repository->delete(
            $id
        );
    }
}

