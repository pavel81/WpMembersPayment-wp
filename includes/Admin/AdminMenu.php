<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Admin;

use Panda\WpMembersPay\Admin\Membership\Screens\EventsScreen;
use Panda\WpMembersPay\Admin\Membership\Screens\MembershipsScreen;
use Panda\WpMembersPay\Admin\Membership\Screens\PaymentsScreen;
use Panda\WpMembersPay\Admin\Membership\Screens\PlansScreen;

final class AdminMenu
{
    public function __construct(
        private readonly PlansScreen $plansScreen,
        private readonly MembershipsScreen $membershipsScreen,
        private readonly PaymentsScreen $paymentsScreen,
        private readonly EventsScreen $eventsScreen,
    ) {
    }

    public function register(): void
    {
        add_action(
            'admin_menu',
            [$this, 'registerMenus']
        );
    }

    public function registerMenus(): void
    {
        if (! current_user_can('manage_options')) {
            return;
        }

        add_menu_page(
            __('WP Members Pay', 'wp-members-pay'),
            __('WP Members Pay', 'wp-members-pay'),
            'manage_options',
            'pwmp-dashboard',
            [$this->plansScreen, 'render'],
            'dashicons-groups',
            56
        );

        add_submenu_page(
            'pwmp-dashboard',
            __('Membership Plans', 'wp-members-pay'),
            __('Plans', 'wp-members-pay'),
            'manage_options',
            'pwmp-dashboard',
            [$this->plansScreen, 'render']
        );

        add_submenu_page(
            'pwmp-dashboard',
            __('Memberships', 'wp-members-pay'),
            __('Memberships', 'wp-members-pay'),
            'manage_options',
            'pwmp-memberships',
            [$this->membershipsScreen, 'render']
        );

        add_submenu_page(
            'pwmp-dashboard',
            __('Payments', 'wp-members-pay'),
            __('Payments', 'wp-members-pay'),
            'manage_options',
            'pwmp-payments',
            [$this->paymentsScreen, 'render']
        );

        add_submenu_page(
            'pwmp-dashboard',
            __('Events', 'wp-members-pay'),
            __('Events', 'wp-members-pay'),
            'manage_options',
            'pwmp-events',
            [$this->eventsScreen, 'render']
        );
    }
}
