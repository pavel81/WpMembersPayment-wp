<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Services;

use Panda\WpMembersPay\Membership\DTO\MembershipDto;

final class MembershipActivationService
{
    public function __construct(
        private readonly MembershipPlanService $planService,
        private readonly MembershipService $membershipService,
        private readonly MembershipEventService $eventService,
    ) {
    }

    public function activateMembership(
        int $userId,
        int $planId
    ): MembershipDto {
        $plan = $this->planService->findById($planId);

        if ($plan === null) {
            throw new \RuntimeException(
                sprintf(
                    'Membership plan %d not found.',
                    $planId
                )
            );
        }

        $startedAt = current_time('mysql');

        $expiresAt = gmdate(
            'Y-m-d H:i:s',
            strtotime(
                sprintf(
                    '+%d days',
                    $plan->durationDays
                )
            )
        );

        $membership = new MembershipDto(
            id: null,
            userId: $userId,
            planId: $planId,
            status: 'active',
            startedAt: $startedAt,
            expiresAt: $expiresAt,
            cancelledAt: null,
            externalReference: null,
        );

        $membershipId = $this->membershipService->save(
            $membership
        );

        $savedMembership = $this->membershipService->findById(
            $membershipId
        );

        if ($savedMembership === null) {
            throw new \RuntimeException(
                'Failed to load created membership.'
            );
        }

        $this->eventService->create(
            $membershipId,
            'membership_activated',
            wp_json_encode([
                'user_id' => $userId,
                'plan_id' => $planId,
            ])
        );

        return $savedMembership;
    }
}
