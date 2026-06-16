<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Database\Tables;

final class MembershipsTable
{
    public const TABLE_NAME = 'pwmp_memberships';

    public static function getSchema(): string
    {
        return "
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id BIGINT UNSIGNED NOT NULL,
            plan_id BIGINT UNSIGNED NOT NULL,
            status VARCHAR(30) NOT NULL,
            started_at DATETIME NOT NULL,
            expires_at DATETIME NOT NULL,
            cancelled_at DATETIME NULL,
            external_reference VARCHAR(255) NULL,
            created_at DATETIME NOT NULL,
            updated_at DATETIME NULL,
            PRIMARY KEY (id),
            KEY user_id (user_id),
            KEY plan_id (plan_id),
            KEY status (status),
            KEY expires_at (expires_at)
        ";
    }
}
