<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Database\Tables;

final class SecurityEventsTable
{
    public const TABLE_NAME =
        'pwmp_security_events';

    public static function getSchema(): string
    {
        return "
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            event_type VARCHAR(100) NOT NULL,
            ip_address VARCHAR(45) NOT NULL,
            reference_key VARCHAR(255) NULL,
            payload LONGTEXT NULL,
            created_at DATETIME NOT NULL,
            PRIMARY KEY (id),
            KEY event_type (event_type),
            KEY ip_address (ip_address),
            KEY reference_key (reference_key),
            KEY created_at (created_at)
        ";
    }
}
