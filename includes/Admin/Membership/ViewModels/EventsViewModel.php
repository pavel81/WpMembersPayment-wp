<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Admin\Membership\ViewModels;

use Panda\WpMembersPay\Membership\DTO\MembershipEventDto;

final readonly class EventsViewModel
{
    /**
     * @param MembershipEventDto[] $events
     */
    public function __construct(
        public array $events,
    ) {
    }
}
