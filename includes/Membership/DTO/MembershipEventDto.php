<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\DTO;

final readonly class MembershipEventDto
{
    public function __construct(
        public ?int $id,
        public int $membershipId,
        public string $eventType,
        public ?string $eventData = null,
        public ?string $createdAt = null,
    ) {
    }
}
