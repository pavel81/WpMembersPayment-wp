<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Services;

use Panda\WpMembersPay\Membership\Contracts\MembershipPaymentRepositoryInterface;
use Panda\WpMembersPay\Membership\DTO\MembershipPaymentDto;

final class MembershipPaymentService
{
    public function __construct(
        private readonly MembershipPaymentRepositoryInterface $repository
    ) {
    }

    public function findById(
        int $id
    ): ?MembershipPaymentDto {
        return $this->repository->findById(
            $id
        );
    }

    public function findByTransactionId(
        string $transactionId
    ): ?MembershipPaymentDto {
        return $this->repository->findByTransactionId(
            $transactionId
        );
    }

    /**
     * @return MembershipPaymentDto[]
     */
    public function findByMembershipId(
        int $membershipId
    ): array {
        return $this->repository->findByMembershipId(
            $membershipId
        );
    }

    public function save(
        MembershipPaymentDto $payment
    ): int {
        return $this->repository->save(
            $payment
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
