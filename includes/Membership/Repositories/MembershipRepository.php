<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Repositories;

use Panda\WpMembersPay\Database\Tables\MembershipsTable;
use Panda\WpMembersPay\Membership\Contracts\MembershipRepositoryInterface;
use Panda\WpMembersPay\Membership\DTO\MembershipDto;

final class MembershipRepository extends AbstractRepository implements MembershipRepositoryInterface
{
    public function findById(int $id): ?MembershipDto
    {
        $row = $this->findOneById($id);

        return $row !== null
            ? $this->mapRowToDto($row)
            : null;
    }

    public function findActiveByUserId(int $userId): ?MembershipDto
    {
        $row = $this->wpdb->get_row(
            $this->wpdb->prepare(
                sprintf(
                    'SELECT * FROM %s WHERE user_id = %%d AND status = %%s ORDER BY id DESC LIMIT 1',
                    $this->getTableName()
                ),
                $userId,
                'active'
            ),
            ARRAY_A
        );

        return is_array($row)
            ? $this->mapRowToDto($row)
            : null;
    }

    /**
     * @return MembershipDto[]
     */
    public function findByUserId(int $userId): array
    {
        $rows = $this->wpdb->get_results(
            $this->wpdb->prepare(
                sprintf(
                    'SELECT * FROM %s WHERE user_id = %%d ORDER BY id DESC',
                    $this->getTableName()
                ),
                $userId
            ),
            ARRAY_A
        );

        return array_map(
            fn(array $row): MembershipDto => $this->mapRowToDto($row),
            $rows
        );
    }

    public function save(MembershipDto $membership): int
    {
        $data = [
            'user_id'            => $membership->userId,
            'plan_id'            => $membership->planId,
            'status'             => $membership->status,
            'started_at'         => $membership->startedAt,
            'expires_at'         => $membership->expiresAt,
            'cancelled_at'       => $membership->cancelledAt,
            'external_reference' => $membership->externalReference,
            'updated_at'         => $this->now(),
        ];

        if ($membership->id !== null) {
            $this->update(
                $data,
                [
                    'id' => $membership->id,
                ]
            );

            return $membership->id;
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
            . MembershipsTable::TABLE_NAME;
    }

    /**
     * @param array<string,mixed> $row
     */
    private function mapRowToDto(array $row): MembershipDto
    {
        return new MembershipDto(
            id: (int) $row['id'],
            userId: (int) $row['user_id'],
            planId: (int) $row['plan_id'],
            status: (string) $row['status'],
            startedAt: (string) $row['started_at'],
            expiresAt: (string) $row['expires_at'],
            cancelledAt: $row['cancelled_at'] !== null
                ? (string) $row['cancelled_at']
                : null,
            externalReference: $row['external_reference'] !== null
                ? (string) $row['external_reference']
                : null,
        );
    }
}
