<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\DTO;

final readonly class MembershipPlanDto
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $slug,
        public string $description,
        public float $price,
        public string $currency,
        public int $durationDays,
        public int $sortOrder,
        public bool $isActive,
    ) {
    }
}
