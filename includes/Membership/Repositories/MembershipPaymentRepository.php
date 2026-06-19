<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Repositories;

use Panda\WpMembersPay\Database\Tables\MembershipPaymentsTable;
use Panda\WpMembersPay\Membership\Contracts\MembershipPaymentRepositoryInterface;
use Panda\WpMembersPay\Membership\DTO\MembershipPaymentDto;

final class MembershipPaymentRepository extends AbstractRepository implements MembershipPaymentRepositoryInterface
{
    public function findById(int $id): ?MembershipPaymentDto
    {
        $row = $this->findOneById($id);

        return $row !== null
            ? $this->mapRowToDto($row)
            : null;
    }

    public function findByTransactionId(
        string $transactionId
    ): ?MembershipPaymentDto {
        $row = $this->wpdb->get_row(
            $this->wpdb->prepare(
                sprintf(
                    'SELECT * FROM %s WHERE transaction_id = %%s LIMIT 1',
                    $this->getTableName()
                ),
                $transactionId
            ),
            ARRAY_A
        );

        return is_array($row)
            ? $this->mapRowToDto($row)
            : null;
    }

    /**
     * @return MembershipPaymentDto[]
     */
    public function findByMembershipId(
        int $membershipId
    ): array {
        $rows = $this->wpdb->get_results(
            $this->wpdb->prepare(
                sprintf(
                    'SELECT * FROM %s WHERE membership_id = %%d ORDER BY id DESC',
                    $this->getTableName()
                ),
                $membershipId
            ),
            ARRAY_A
        );

        return array_map(
            fn(array $row): MembershipPaymentDto => $this->mapRowToDto($row),
            $rows
        );
    }

    public function save(
        MembershipPaymentDto $payment
    ): int {
        $data = [
            'membership_id'   => $payment->membershipId,
            'payment_gateway' => $payment->paymentGateway,
            'transaction_id'  => $payment->transactionId,
            'amount'          => $payment->amount,
            'currency'        => $payment->currency,
            'status'          => $payment->status,
            'gateway_payload' => $payment->gatewayPayload,
            'paid_at'         => $payment->paidAt,
            'updated_at'      => $this->now(),
        ];

        if ($payment->id !== null) {
            $this->update(
                $data,
                [
                    'id' => $payment->id,
                ]
            );

            return $payment->id;
        }

        $data['created_at'] = $this->now();

        return $this->insert($data);
    }

    public function delete(int $id): bool
    {
        return $this->deleteRow([
            'id' => $id,
        ]);
    }

    protected function getTableName(): string
    {
        return $this->wpdb->prefix
            . MembershipPaymentsTable::TABLE_NAME;
    }

    /**
     * @param array<string,mixed> $row
     */
    private function mapRowToDto(array $row): MembershipPaymentDto
    {
        return new MembershipPaymentDto(
            id: (int) $row['id'],
            membershipId: (int) $row['membership_id'],
            paymentGateway: (string) $row['payment_gateway'],
            transactionId: (string) $row['transaction_id'],
            amount: (float) $row['amount'],
            currency: (string) $row['currency'],
            status: (string) $row['status'],
            gatewayPayload: $row['gateway_payload'] !== null
                ? (string) $row['gateway_payload']
                : null,
            paidAt: $row['paid_at'] !== null
                ? (string) $row['paid_at']
                : null,
        );
    }
}
