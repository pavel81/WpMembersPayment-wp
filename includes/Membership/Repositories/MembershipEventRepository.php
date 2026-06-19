<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Repositories;

use Panda\WpMembersPay\Database\Tables\MembershipEventsTable;
use Panda\WpMembersPay\Membership\Contracts\MembershipEventRepositoryInterface;
use Panda\WpMembersPay\Membership\DTO\MembershipEventDto;

final class MembershipEventRepository extends AbstractRepository implements MembershipEventRepositoryInterface
{
    public function findById(int $id): ?MembershipEventDto
    {
        $row = $this->findOneById($id);

        return $row !== null
            ? $this->mapRowToDto($row)
            : null;
    }

    /**
     * @return MembershipEventDto[]
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
            fn(array $row): MembershipEventDto => $this->mapRowToDto($row),
            $rows
        );
    }

    public function save(
        MembershipEventDto $event
    ): int {
        $data = [
            'membership_id' => $event->membershipId,
            'event_type'    => $event->eventType,
            'event_data'    => $event->eventData,
        ];

        if ($event->id !== null) {
            $this->update(
                $data,
                [
                    'id' => $event->id,
                ]
            );

            return $event->id;
        }

        $data['created_at'] = $event->createdAt
            ?? $this->now();

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
            . MembershipEventsTable::TABLE_NAME;
    }

    /**
     * @param array<string,mixed> $row
     */
    private function mapRowToDto(array $row): MembershipEventDto
    {
        return new MembershipEventDto(
            id: (int) $row['id'],
            membershipId: (int) $row['membership_id'],
            eventType: (string) $row['event_type'],
            eventData: $row['event_data'] !== null
                ? (string) $row['event_data']
                : null,
            createdAt: $row['created_at'] !== null
                ? (string) $row['created_at']
                : null,
        );
    }
}
