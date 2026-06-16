<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Database\Tables;

final class MembershipPaymentsTable
{
    public const TABLE_NAME = 'pwmp_membership_payments';

    public static function getSchema(): string
    {
        return "
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            membership_id BIGINT UNSIGNED NOT NULL,
            payment_gateway VARCHAR(50) NOT NULL,
            transaction_id VARCHAR(255) NOT NULL,
            amount DECIMAL(10,2) NOT NULL,
            currency VARCHAR(10) NOT NULL DEFAULT 'CZK',
            status VARCHAR(30) NOT NULL,
            gateway_payload LONGTEXT NULL,
            paid_at DATETIME NULL,
            created_at DATETIME NOT NULL,
            updated_at DATETIME NULL,
            PRIMARY KEY (id),
            UNIQUE KEY transaction_id (transaction_id),
            KEY membership_id (membership_id),
            KEY payment_gateway (payment_gateway),
            KEY status (status)
        ";
    }
}
