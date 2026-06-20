<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Providers;

use Panda\WpMembersPay\Container\ServiceContainer;
use Panda\WpMembersPay\Membership\Repositories\MembershipBenefitRepository;
use Panda\WpMembersPay\Membership\Repositories\MembershipEventRepository;
use Panda\WpMembersPay\Membership\Repositories\MembershipPaymentRepository;
use Panda\WpMembersPay\Membership\Repositories\MembershipPlanRepository;
use Panda\WpMembersPay\Membership\Repositories\MembershipRepository;
use Panda\WpMembersPay\Membership\Services\MembershipActivationService;
use Panda\WpMembersPay\Membership\Services\MembershipBenefitService;
use Panda\WpMembersPay\Membership\Services\MembershipCancellationService;
use Panda\WpMembersPay\Membership\Services\MembershipEventService;
use Panda\WpMembersPay\Membership\Services\MembershipExpirationService;
use Panda\WpMembersPay\Membership\Services\MembershipPaymentService;
use Panda\WpMembersPay\Membership\Services\MembershipPlanService;
use Panda\WpMembersPay\Membership\Services\MembershipRenewalService;
use Panda\WpMembersPay\Membership\Services\MembershipService;
use wpdb;

final class MembershipServiceProvider
{
    public function register(
        ServiceContainer $container,
        wpdb $wpdb
    ): void {
        $planRepository = new MembershipPlanRepository($wpdb);
        $membershipRepository = new MembershipRepository($wpdb);
        $benefitRepository = new MembershipBenefitRepository($wpdb);
        $paymentRepository = new MembershipPaymentRepository($wpdb);
        $eventRepository = new MembershipEventRepository($wpdb);

        $planService = new MembershipPlanService(
            $planRepository
        );

        $membershipService = new MembershipService(
            $membershipRepository
        );

        $benefitService = new MembershipBenefitService(
            $benefitRepository
        );

        $paymentService = new MembershipPaymentService(
            $paymentRepository
        );

        $eventService = new MembershipEventService(
            $eventRepository
        );

        $container->set(
            MembershipPlanService::class,
            $planService
        );

        $container->set(
            MembershipService::class,
            $membershipService
        );

        $container->set(
            MembershipBenefitService::class,
            $benefitService
        );

        $container->set(
            MembershipPaymentService::class,
            $paymentService
        );

        $container->set(
            MembershipEventService::class,
            $eventService
        );

        $container->set(
            MembershipActivationService::class,
            new MembershipActivationService(
                $planService,
                $membershipService,
                $eventService
            )
        );

        $container->set(
            MembershipRenewalService::class,
            new MembershipRenewalService(
                $membershipService,
                $planService,
                $eventService
            )
        );

        $container->set(
            MembershipExpirationService::class,
            new MembershipExpirationService(
                $membershipService,
                $eventService
            )
        );

                  $container->set(
            MembershipCancellationService::class,
            new MembershipCancellationService(
                $membershipService,
                $eventService
            )
        );
        

        /**
         * Fired after all core services are registered.
         *
         * Allows addons and integrations to register
         * additional services and hooks.
         *
         * @param ServiceContainer $container
         */
        do_action(
            'pwmp_integrations_loaded',
            $container
        );
        
        
                /**
         * Fired after all core services are registered.
         *
         * Allows addons and integrations to register
         * additional services and hooks.
         *
         * @param ServiceContainer $container
         */
        do_action(
            'pwmp_integrations_loaded',
            $container
        );
    }
}
    


