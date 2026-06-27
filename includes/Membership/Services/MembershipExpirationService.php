<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\Services;

use Panda\WpMembersPay\Membership\DTO\MembershipDto;
use Panda\WpMembersPay\Membership\ValueObjects\MembershipEventType;

final class MembershipExpirationService
{
    public function __construct(
        private readonly MembershipService $membershipService,
        private readonly MembershipEventService $eventService,
    ) {
    }

    public function expireMembership(
        int $membershipId
    ): ?MembershipDto {
        $membership = $this->membershipService->findById(
            $membershipId
        );

        if ($membership === null) {
            return null;
        }

        if ($membership->status === 'expired') {
            return $membership;
        }

        $expiredMembership = new MembershipDto(
            id: $membership->id,
            userId: $membership->userId,
            planId: $membership->planId,
            status: 'expired',
            startedAt: $membership->startedAt,
            expiresAt: $membership->expiresAt,
            cancelledAt: $membership->cancelledAt,
            externalReference: $membership->externalReference,
        );

        $this->membershipService->save(
            $expiredMembership
        );

        $this->eventService->record(
    $membershipId,
    MembershipEventType::EXPIRE,
    [
        'user_id'    => $membership->userId,
        'plan_id'    => $membership->planId,
        'expires_at' => $expiresAt,
    ]
);

        return $this->membershipService->findById(
            $membershipId
        );
    }
}
