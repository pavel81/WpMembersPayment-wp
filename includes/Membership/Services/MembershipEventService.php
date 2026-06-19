<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Services;

use Panda\WpMembersPay\Membership\Contracts\MembershipEventRepositoryInterface;
use Panda\WpMembersPay\Membership\DTO\MembershipEventDto;

final class MembershipEventService
{
    public function __construct(
        private readonly MembershipEventRepositoryInterface $repository
    ) {
    }

    public function findById(
        int $id
    ): ?MembershipEventDto {
        return $this->repository->findById($id);
    }

    /**
     * @return MembershipEventDto[]
     */
    public function findByMembershipId(
        int $membershipId
    ): array {
        return $this->repository->findByMembershipId(
            $membershipId
        );
    }

    public function create(
        int $membershipId,
        string $eventType,
        ?string $eventData = null
    ): int {
        return $this->repository->save(
            new MembershipEventDto(
                id: null,
                membershipId: $membershipId,
                eventType: $eventType,
                eventData: $eventData,
                createdAt: null,
            )
        );
    }

    public function save(
        MembershipEventDto $event
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
