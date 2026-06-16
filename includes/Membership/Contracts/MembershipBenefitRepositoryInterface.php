<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Contracts;

use Panda\WpMembersPay\Membership\DTO\MembershipBenefitDto;

interface MembershipBenefitRepositoryInterface
{
    public function findById(int $id): ?MembershipBenefitDto;

    /**
     * @return MembershipBenefitDto[]
     */
    public function findByPlanId(int $planId): array;

    public function save(MembershipBenefitDto $benefit): int;

    public function delete(int $id): bool;
}
