<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Providers;

use Panda\WpMembersPay\Admin\AdminMenu;
use Panda\WpMembersPay\Admin\Membership\Renderers\EventsRenderer;
use Panda\WpMembersPay\Admin\Membership\Renderers\MembershipsRenderer;
use Panda\WpMembersPay\Admin\Membership\Renderers\PaymentsRenderer;
use Panda\WpMembersPay\Admin\Membership\Renderers\PlansRenderer;
use Panda\WpMembersPay\Admin\Membership\Screens\EventsScreen;
use Panda\WpMembersPay\Admin\Membership\Screens\MembershipsScreen;
use Panda\WpMembersPay\Admin\Membership\Screens\PaymentsScreen;
use Panda\WpMembersPay\Admin\Membership\Screens\PlansScreen;
use Panda\WpMembersPay\Container\ServiceContainer;
use Panda\WpMembersPay\Membership\Services\MembershipEventService;
use Panda\WpMembersPay\Membership\Services\MembershipPaymentService;
use Panda\WpMembersPay\Membership\Services\MembershipPlanService;
use Panda\WpMembersPay\Membership\Services\MembershipService;

final class AdminServiceProvider
{
    public function register(
        ServiceContainer $container
    ): void {
        $plansRenderer = new PlansRenderer();

        $membershipsRenderer = new MembershipsRenderer();

        $paymentsRenderer = new PaymentsRenderer();

        $eventsRenderer = new EventsRenderer();

        $plansScreen = new PlansScreen(
            $container->get(
                MembershipPlanService::class
            ),
            $plansRenderer
        );

        $membershipsScreen = new MembershipsScreen(
            $container->get(
                MembershipService::class
            ),
            $membershipsRenderer
        );

        $paymentsScreen = new PaymentsScreen(
            $container->get(
                MembershipPaymentService::class
            ),
            $paymentsRenderer
        );

        $eventsScreen = new EventsScreen(
            $container->get(
                MembershipEventService::class
            ),
            $eventsRenderer
        );

        $container->set(
            PlansRenderer::class,
            $plansRenderer
        );

        $container->set(
            MembershipsRenderer::class,
            $membershipsRenderer
        );

        $container->set(
            PaymentsRenderer::class,
            $paymentsRenderer
        );

        $container->set(
            EventsRenderer::class,
            $eventsRenderer
        );

        $container->set(
            PlansScreen::class,
            $plansScreen
        );

        $container->set(
            MembershipsScreen::class,
            $membershipsScreen
        );

        $container->set(
            PaymentsScreen::class,
            $paymentsScreen
        );

        $container->set(
            EventsScreen::class,
            $eventsScreen
        );

        $container->set(
            AdminMenu::class,
            new AdminMenu(
                $plansScreen,
                $membershipsScreen,
                $paymentsScreen,
                $eventsScreen
            )
        );
    }
}
