<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\Repositories;

use Panda\WpMembersPay\Database\Tables\SecurityEventsTable;
use Panda\WpMembersPay\Membership\Repositories\AbstractRepository;
use Panda\WpMembersPay\Payments\Contracts\SecurityEventRepositoryInterface;
use Panda\WpMembersPay\Payments\DTO\SecurityEventDto;

final class SecurityEventRepository extends AbstractRepository implements SecurityEventRepositoryInterface
{
    public function findById(
        int $id
    ): ?SecurityEventDto {
        $row = $this->findOneById($id);

        return $row !== null
            ? $this->mapRowToDto($row)
            : null;
    }

    /**
     * @return SecurityEventDto[]
     */
    public function findAll(): array
    {
        $rows = $this->findAllRows(
            'id DESC'
        );

        return array_map(
            fn (array $row): SecurityEventDto => $this->mapRowToDto($row),
            $rows
        );
    }

    /**
     * @return SecurityEventDto[]
     */
    public function findByEventType(
        string $eventType
    ): array {
        $rows = $this->findBy(
            'event_type = %s',
            [$eventType],
            'id DESC'
        );

        return array_map(
            fn (array $row): SecurityEventDto => $this->mapRowToDto($row),
            $rows
        );
    }

    /**
     * @return SecurityEventDto[]
     */
    public function findByReferenceKey(
        string $referenceKey
    ): array {
        $rows = $this->findBy(
            'reference_key = %s',
            [$referenceKey],
            'id DESC'
        );

        return array_map(
            fn (array $row): SecurityEventDto => $this->mapRowToDto($row),
            $rows
        );
    }

    public function save(
        SecurityEventDto $event
    ): int {
        $data = [
            'event_type'    => $event->eventType,
            'ip_address'    => $event->ipAddress,
            'reference_key' => $event->referenceKey,
            'payload'       => $event->payload,
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

    public function delete(
        int $id
    ): bool {
        return $this->deleteRow([
            'id' => $id,
        ]);
    }

    protected function getTableName(): string
    {
        return $this->wpdb->prefix
            . SecurityEventsTable::TABLE_NAME;
    }

    /**
     * @param array<string,mixed> $row
     */
    private function mapRowToDto(
        array $row
    ): SecurityEventDto {
        return new SecurityEventDto(
            id: (int) $row['id'],
            eventType: (string) $row['event_type'],
            ipAddress: (string) $row['ip_address'],
            referenceKey: $row['reference_key'] !== null
                ? (string) $row['reference_key']
                : null,
            payload: $row['payload'] !== null
                ? (string) $row['payload']
                : null,
            createdAt: $row['created_at'] !== null
                ? (string) $row['created_at']
                : null,
        );
    }
}
