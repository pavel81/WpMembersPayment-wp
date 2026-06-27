<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Services;

use Panda\WpMembersPay\Membership\DTO\MembershipDto;
use Panda\WpMembersPay\Membership\ValueObjects\MembershipEventType;

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
        $plan = $this->planService->findById(
            $planId
        );

        if ($plan === null) {
            throw new \RuntimeException(
                sprintf(
                    'Membership plan %d not found.',
                    $planId
                )
            );
        }

        $startedAt = current_time(
            'mysql'
        );

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

        $this->eventService->record(
    $membershipId,
    MembershipEventType::ACTIVATION,
    [
        'user_id'    => $membership->userId,
        'plan_id'    => $membership->planId,
        'expires_at' => $expiresAt,
    ]
);

        do_action(
            'pwmp_membership_activated',
            $savedMembership
        );

        return $savedMembership;
    }
}
