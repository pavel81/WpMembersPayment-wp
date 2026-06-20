<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Services;

use Panda\WpMembersPay\Membership\DTO\MembershipDto;

final class MembershipCancellationService
{
    public function __construct(
        private readonly MembershipService $membershipService,
        private readonly MembershipEventService $eventService,
    ) {
    }

do_action(
    'pwmp_membership_cancelled',
    $membership
);

    public function cancelMembership(
        int $membershipId
    ): ?MembershipDto {
        $membership = $this->membershipService->findById(
            $membershipId
        );

        if ($membership === null) {
            return null;
        }

        $cancelledMembership = new MembershipDto(
            id: $membership->id,
            userId: $membership->userId,
            planId: $membership->planId,
            status: 'cancelled',
            startedAt: $membership->startedAt,
            expiresAt: $membership->expiresAt,
            cancelledAt: current_time('mysql'),
            externalReference: $membership->externalReference,
        );

        $this->membershipService->save(
            $cancelledMembership
        );

        $this->eventService->create(
            $membershipId,
            'membership_cancelled',
            null
        );

        return $this->membershipService->findById(
            $membershipId
        );
    }
}
