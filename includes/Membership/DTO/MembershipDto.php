<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\DTO;

final readonly class MembershipDto
{
    public function __construct(
        public ?int $id,
        public int $userId,
        public int $planId,
        public string $status,
        public string $startedAt,
        public string $expiresAt,
        public ?string $cancelledAt,
        public ?string $externalReference,
    ) {
    }
}
