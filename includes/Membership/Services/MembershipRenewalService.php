<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Services;

use Panda\WpMembersPay\Membership\DTO\MembershipDto;
use Panda\WpMembersPay\Membership\ValueObjects\MembershipEventType;

final class MembershipRenewalService
{
    public function __construct(
        private readonly MembershipService $membershipService,
        private readonly MembershipPlanService $planService,
        private readonly MembershipEventService $eventService,
    ) {
    }

    public function renewMembership(
        int $membershipId
    ): ?MembershipDto {
        $membership = $this->membershipService->findById(
            $membershipId
        );

        if ($membership === null) {
            return null;
        }

        $plan = $this->planService->findById(
            $membership->planId
        );

        if ($plan === null) {
            return null;
        }

        $baseDate = $membership->expiresAt
            ?? current_time('mysql');

        $expiresAt = gmdate(
            'Y-m-d H:i:s',
            strtotime(
                sprintf(
                    '+%d days',
                    $plan->durationDays
                ),
                strtotime($baseDate)
            )
        );

        $renewedMembership = new MembershipDto(
            id: $membership->id,
            userId: $membership->userId,
            planId: $membership->planId,
            status: 'active',
            startedAt: $membership->startedAt,
            expiresAt: $expiresAt,
            cancelledAt: null,
            externalReference: $membership->externalReference,
        );

        $this->membershipService->save(
            $renewedMembership
        );

        $this->eventService->record(
    $membershipId,
    MembershipEventType::RENEWED,
    [
        'user_id'    => $membership->userId,
        'plan_id'    => $membership->planId,
        'expires_at' => $expiresAt,
    ]
);

        $savedMembership = $this->membershipService->findById(
            $membershipId
        );

        if ($savedMembership !== null) {
            do_action(
                'pwmp_membership_renewed',
                $savedMembership
            );
        }

        return $savedMembership;
    }
}
