<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Contracts;

use Panda\WpMembersPay\Membership\DTO\MembershipPlanDto;

interface MembershipPlanRepositoryInterface
{
    public function findById(int $id): ?MembershipPlanDto;

    public function findBySlug(string $slug): ?MembershipPlanDto;

    /**
     * @return MembershipPlanDto[]
     */
    public function findAll(): array;

    /**
     * @return MembershipPlanDto[]
     */
    public function findActive(): array;

    public function save(MembershipPlanDto $plan): int;

    public function delete(int $id): bool;
}
