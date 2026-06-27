<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Services;

use Panda\WpMembersPay\Membership\DTO\MembershipDto;
use Panda\WpMembersPay\Membership\ValueObjects\MembershipEventType;

final class MembershipCancellationService
{
    public function __construct(
        private readonly MembershipService $membershipService,
        private readonly MembershipEventService $eventService,
    ) {
    }

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
            cancelledAt: current_time(
                'mysql'
            ),
            externalReference: $membership->externalReference,
        );

        $this->membershipService->save(
            $cancelledMembership
        );

        $this->eventService->record(
    $membershipId,
    MembershipEventType::CANCELLED,
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
                'pwmp_membership_cancelled',
                $savedMembership
            );
        }

        return $savedMembership;
    }
}
