<?php

declare(strict_types=1);

use Panda\WpMembersPay\Admin\AdminMenu;
use Panda\WpMembersPay\Container\ServiceContainer;
use Panda\WpMembersPay\Database\SchemaManager;
use Panda\WpMembersPay\Providers\AdminServiceProvider;
use Panda\WpMembersPay\Providers\MembershipServiceProvider;

register_activation_hook(
    PWMP_FILE,
    static function (): void {
        global $wpdb;

        $schemaManager = new SchemaManager(
            $wpdb
        );

        $schemaManager->install();
    }
);

add_action(
    'plugins_loaded',
    static function (): void {

        load_plugin_textdomain(
            'wp-members-pay',
            false,
            dirname(
                plugin_basename(
                    PWMP_FILE
                )
            ) . '/languages'
        );

        global $wpdb;

        $container = new ServiceContainer();

        $membershipProvider =
            new MembershipServiceProvider();

        $membershipProvider->register(
            $container,
            $wpdb
        );

        $adminProvider =
            new AdminServiceProvider();

        $adminProvider->register(
            $container
        );

        $adminMenu = $container->get(
            AdminMenu::class
        );

        if ($adminMenu instanceof AdminMenu) {
            $adminMenu->register();
        }
    }
);
