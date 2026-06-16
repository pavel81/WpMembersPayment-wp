<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\DTO;

final readonly class MembershipBenefitDto
{
    public function __construct(
        public ?int $id,
        public int $planId,
        public string $benefitKey,
        public string $benefitValue,
        public ?string $description = null,
    ) {
    }
}
