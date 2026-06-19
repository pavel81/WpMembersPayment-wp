<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Services;

use Panda\WpMembersPay\Membership\Contracts\MembershipRepositoryInterface;
use Panda\WpMembersPay\Membership\DTO\MembershipDto;

final class MembershipService
{
    public function __construct(
        private readonly MembershipRepositoryInterface $repository
    ) {
    }

    public function findById(
        int $id
    ): ?MembershipDto {
        return $this->repository->findById(
            $id
        );
    }

    public function findActiveByUserId(
        int $userId
    ): ?MembershipDto {
        return $this->repository->findActiveByUserId(
            $userId
        );
    }

    /**
     * @return MembershipDto[]
     */
    public function findByUserId(
        int $userId
    ): array {
        return $this->repository->findByUserId(
            $userId
        );
    }

    public function save(
        MembershipDto $membership
    ): int {
        return $this->repository->save(
            $membership
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
