<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Services;

use Panda\WpMembersPay\Membership\Contracts\MembershipBenefitRepositoryInterface;
use Panda\WpMembersPay\Membership\DTO\MembershipBenefitDto;

final class MembershipBenefitService
{
    public function __construct(
        private readonly MembershipBenefitRepositoryInterface $repository
    ) {
    }

    public function findById(
        int $id
    ): ?MembershipBenefitDto {
        return $this->repository->findById(
            $id
        );
    }

    /**
     * @return MembershipBenefitDto[]
     */
    public function findByPlanId(
        int $planId
    ): array {
        return $this->repository->findByPlanId(
            $planId
        );
    }

    public function save(
        MembershipBenefitDto $benefit
    ): int {
        return $this->repository->save(
            $benefit
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
