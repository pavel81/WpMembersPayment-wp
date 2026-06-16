<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\ValueObjects;

final class MembershipStatus
{
    public const PENDING = 'pending';

    public const ACTIVE = 'active';

    public const EXPIRED = 'expired';

    public const CANCELLED = 'cancelled';

    public const SUSPENDED = 'suspended';

    private function __construct()
    {
    }
}
