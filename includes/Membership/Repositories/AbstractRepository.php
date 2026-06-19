<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Repositories;

use wpdb;

abstract class AbstractRepository
{
    public function __construct(
        protected readonly wpdb $wpdb
    ) {
    }

    abstract protected function getTableName(): string;

    protected function now(): string
    {
        return current_time('mysql');
    }

    /**
     * @param array<string,mixed> $data
     */
    protected function insert(array $data): int
    {
        $this->wpdb->insert(
            $this->getTableName(),
            $data
        );

        return (int) $this->wpdb->insert_id;
    }

    /**
     * @param array<string,mixed> $data
     * @param array<string,mixed> $where
     */
    protected function update(
        array $data,
        array $where
    ): bool {
        return (bool) $this->wpdb->update(
            $this->getTableName(),
            $data,
            $where
        );
    }

    /**
     * @param array<string,mixed> $where
     */
    protected function deleteRow(
        array $where
    ): bool {
        return (bool) $this->wpdb->delete(
            $this->getTableName(),
            $where
        );
    }

    /**
     * @return array<string,mixed>|null
     */
    protected function findOneById(
        int $id
    ): ?array {
        $row = $this->wpdb->get_row(
            $this->wpdb->prepare(
                sprintf(
                    'SELECT * FROM %s WHERE id = %%d',
                    $this->getTableName()
                ),
                $id
            ),
            ARRAY_A
        );

        return is_array($row)
            ? $row
            : null;
    }

    /**
     * @return array<int,array<string,mixed>>
     */
    protected function findAllRows(
        string $orderBy = 'id ASC'
    ): array {
        return $this->wpdb->get_results(
            sprintf(
                'SELECT * FROM %s ORDER BY %s',
                $this->getTableName(),
                $orderBy
            ),
            ARRAY_A
        );
    }
    /**
 * @return array<int,array<string,mixed>>
 */
protected function findBy(
    string $where,
    array $params = [],
    string $orderBy = 'id ASC'
): array {
    $sql = sprintf(
        'SELECT * FROM %s WHERE %s ORDER BY %s',
        $this->getTableName(),
        $where,
        $orderBy
    );

    if ($params !== []) {
        $sql = $this->wpdb->prepare(
            $sql,
            ...$params
        );
    }

    return $this->wpdb->get_results(
        $sql,
        ARRAY_A
    );
}
}
