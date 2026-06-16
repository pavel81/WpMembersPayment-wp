<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Database\Tables;


final class MembershipBenefitsTable
{
    public const TABLE_NAME = 'pwmp_membership_benefits';

    public static function getSchema(): string
    {
        return "
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            plan_id BIGINT UNSIGNED NOT NULL,
            benefit_key VARCHAR(100) NOT NULL,
            benefit_value VARCHAR(255) NOT NULL,
            description TEXT NULL,
            created_at DATETIME NOT NULL,
            updated_at DATETIME NULL,
            PRIMARY KEY (id),
            KEY plan_id (plan_id),
            KEY benefit_key (benefit_key)
        ";
    }
}
