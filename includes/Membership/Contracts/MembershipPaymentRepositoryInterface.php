<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Contracts;

use Panda\WpMembersPay\Membership\DTO\MembershipPaymentDto;

interface MembershipPaymentRepositoryInterface
{
    public function findById(int $id): ?MembershipPaymentDto;

    public function findByTransactionId(
        string $transactionId
    ): ?MembershipPaymentDto;

    /**
     * @return MembershipPaymentDto[]
     */
    public function findByMembershipId(
        int $membershipId
    ): array;

    public function save(
        MembershipPaymentDto $payment
    ): int;

    public function delete(
        int $id
    ): bool;

/**
 * @return MembershipPaymentDto[]
 */
public function findAll(): array;
{
}
}
