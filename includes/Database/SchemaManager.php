<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Database;

use Panda\WpMembersPay\Database\Tables\MembershipBenefitsTable;
use Panda\WpMembersPay\Database\Tables\MembershipEventsTable;
use Panda\WpMembersPay\Database\Tables\MembershipPaymentsTable;
use Panda\WpMembersPay\Database\Tables\MembershipPlansTable;
use Panda\WpMembersPay\Database\Tables\MembershipsTable;
use wpdb;

final class SchemaManager
{
    public function __construct(
        private readonly wpdb $wpdb
    ) {
    }

    public function install(): void
    {
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        foreach ($this->getTables() as $tableClass) {
            dbDelta($this->buildSql($tableClass));
        }
    }

    /**
     * @return array<class-string>
     */
    private function getTables(): array
    {
        return [
            MembershipPlansTable::class,
            MembershipsTable::class,
            MembershipBenefitsTable::class,
            MembershipPaymentsTable::class,
            MembershipEventsTable::class,
        ];
    }

    private function buildSql(string $tableClass): string
    {
        $tableName = $this->wpdb->prefix . $tableClass::TABLE_NAME;

        return sprintf(
            'CREATE TABLE %s (%s) %s;',
            $tableName,
            $tableClass::getSchema(),
            $this->wpdb->get_charset_collate()
        );
    }
    
    public function maybeUpgrade(): void
{
    $installedVersion = get_option(
        DatabaseVersion::OPTION_NAME,
        ''
    );

    if ($installedVersion === DatabaseVersion::VERSION) {
        return;
    }

    $this->install();

    update_option(
        DatabaseVersion::OPTION_NAME,
        DatabaseVersion::VERSION
    );
}
}
