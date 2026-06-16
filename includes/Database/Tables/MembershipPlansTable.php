<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Database\Tables;

final class MembershipPlansTable
{
    public const TABLE_NAME = 'pwmp_membership_plans';

    public static function getSchema(): string
    {
        return "
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            slug VARCHAR(100) NOT NULL,
            description TEXT NULL,
            price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            currency VARCHAR(10) NOT NULL DEFAULT 'CZK',
            duration_days INT UNSIGNED NOT NULL,
            sort_order INT UNSIGNED NOT NULL DEFAULT 0,
            is_active TINYINT(1) NOT NULL DEFAULT 1,
            created_at DATETIME NOT NULL,
            updated_at DATETIME NULL,
            PRIMARY KEY (id),
            UNIQUE KEY slug (slug),
            KEY is_active (is_active)
        ";
    }
}
