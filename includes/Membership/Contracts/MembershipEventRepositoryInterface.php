<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Contracts;

use Panda\WpMembersPay\Membership\DTO\MembershipEventDto;

interface MembershipEventRepositoryInterface
{
    public function findById(int $id): ?MembershipEventDto;

    /**
     * @return MembershipEventDto[]
     */
    public function findByMembershipId(
        int $membershipId
    ): array;

    public function save(
        MembershipEventDto $event
    ): int;

    public function delete(
        int $id
    ): bool;
}
