<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Contracts;

use Panda\WpMembersPay\Membership\DTO\MembershipDto;

interface MembershipRepositoryInterface
{
    public function findById(int $id): ?MembershipDto;

    /**
     * @return MembershipDto[]
     */
    public function findAll(): array;

    public function findActiveByUserId(int $userId): ?MembershipDto;

    /**
     * @return MembershipDto[]
     */
    public function findByUserId(int $userId): array;

    public function save(MembershipDto $membership): int;

    public function delete(int $id): bool;
}
