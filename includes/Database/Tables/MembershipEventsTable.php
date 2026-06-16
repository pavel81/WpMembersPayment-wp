<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Database\Tables;

final class MembershipEventsTable
{
    public const TABLE_NAME = 'pwmp_membership_events';

    public static function getSchema(): string
    {
        return "
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            membership_id BIGINT UNSIGNED NOT NULL,
            event_type VARCHAR(100) NOT NULL,
            event_data LONGTEXT NULL,
            created_at DATETIME NOT NULL,
            PRIMARY KEY (id),
            KEY membership_id (membership_id),
            KEY event_type (event_type)
        ";
    }
}
