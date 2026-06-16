<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\ValueObjects;

final class PaymentStatus
{
    public const PENDING = 'pending';

    public const PAID = 'paid';

    public const FAILED = 'failed';

    public const REFUNDED = 'refunded';

    public const CANCELLED = 'cancelled';

    private function __construct()
    {
    }
}
