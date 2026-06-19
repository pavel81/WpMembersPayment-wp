<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Services;

use Panda\WpMembersPay\Membership\Contracts\MembershipPlanRepositoryInterface;
use Panda\WpMembersPay\Membership\DTO\MembershipPlanDto;

final class MembershipPlanService
{
    public function __construct(
        private readonly MembershipPlanRepositoryInterface $repository
    ) {
    }

    public function findById(
        int $id
    ): ?MembershipPlanDto {
        return $this->repository->findById($id);
    }

    public function findBySlug(
        string $slug
    ): ?MembershipPlanDto {
        return $this->repository->findBySlug(
            $slug
        );
    }

    /**
     * @return MembershipPlanDto[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @return MembershipPlanDto[]
     */
    public function findActive(): array
    {
        return $this->repository->findActive();
    }

    public function save(
        MembershipPlanDto $plan
    ): int {
        return $this->repository->save(
            $plan
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
