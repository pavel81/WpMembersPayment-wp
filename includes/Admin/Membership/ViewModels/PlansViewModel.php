<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Admin\Membership\ViewModels;

use Panda\WpMembersPay\Membership\DTO\MembershipPlanDto;

final readonly class PlansViewModel
{
    /**
     * @param MembershipPlanDto[] $plans
     */
    public function __construct(
        public array $plans,
    ) {
    }
}
