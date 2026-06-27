<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Services;

use Panda\WpMembersPay\Membership\Contracts\MembershipPaymentRepositoryInterface;
use Panda\WpMembersPay\Membership\DTO\MembershipPaymentDto;
use Panda\WpMembersPay\Membership\ValueObjects\MembershipEventType;
use Panda\WpMembersPay\Membership\ValueObjects\PaymentStatus;

final class MembershipPaymentService
{
    public function __construct(
        private readonly MembershipPaymentRepositoryInterface $repository,
        private readonly MembershipEventService $eventService,
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

    /**
     * @return MembershipPaymentDto[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
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

    public function markPaid(
        int $paymentId
    ): ?MembershipPaymentDto {
        return $this->updateStatus(
            $paymentId,
            PaymentStatus::PAID,
            MembershipEventType::PAYMENT_COMPLETED,
            'pwmp_payment_completed',
            true
        );
    }

    public function markFailed(
        int $paymentId
    ): ?MembershipPaymentDto {
        return $this->updateStatus(
            $paymentId,
            PaymentStatus::FAILED,
            MembershipEventType::PAYMENT_FAILED,
            'pwmp_payment_failed'
        );
    }

    public function markRefunded(
        int $paymentId
    ): ?MembershipPaymentDto {
        return $this->updateStatus(
            $paymentId,
            PaymentStatus::REFUNDED,
            MembershipEventType::PAYMENT_REFUNDED,
            'pwmp_payment_refunded'
        );
    }

    public function markCancelled(
        int $paymentId
    ): ?MembershipPaymentDto {
        return $this->updateStatus(
            $paymentId,
            PaymentStatus::CANCELLED,
            MembershipEventType::PAYMENT_CANCELLED,
            'pwmp_payment_cancelled'
        );
    }

    private function updateStatus(
        int $paymentId,
        string $status,
        string $eventType,
        string $hook,
        bool $setPaidAt = false
    ): ?MembershipPaymentDto {
        $payment = $this->findById(
            $paymentId
        );

        if ($payment === null) {
            return null;
        }

        $updatedPayment = new MembershipPaymentDto(
            id: $payment->id,
            membershipId: $payment->membershipId,
            paymentGateway: $payment->paymentGateway,
            transactionId: $payment->transactionId,
            amount: $payment->amount,
            currency: $payment->currency,
            status: $status,
            gatewayPayload: $payment->gatewayPayload,
            paidAt: $setPaidAt
                ? current_time('mysql')
                : $payment->paidAt,
        );

        $this->save(
            $updatedPayment
        );

        $savedPayment = $this->findById(
            $paymentId
        );

        if ($savedPayment === null) {
            return null;
        }

        $this->eventService->create(
            $savedPayment->membershipId,
            $eventType,
            wp_json_encode([
                'payment_id'     => $savedPayment->id,
                'membership_id'  => $savedPayment->membershipId,
                'gateway'        => $savedPayment->paymentGateway,
                'transaction_id' => $savedPayment->transactionId,
                'amount'         => $savedPayment->amount,
                'currency'       => $savedPayment->currency,
                'status'         => $savedPayment->status,
            ])
        );

        do_action(
            $hook,
            $savedPayment
        );

        return $savedPayment;
    }
}
