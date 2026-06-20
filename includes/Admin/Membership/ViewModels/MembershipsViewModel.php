<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Admin\Membership\ViewModels;

use Panda\WpMembersPay\Membership\DTO\MembershipDto;

final readonly class MembershipsViewModel
{
    /**
     * @param MembershipDto[] $memberships
     */
    public function __construct(
        public array $memberships,
    ) {
    }
}
