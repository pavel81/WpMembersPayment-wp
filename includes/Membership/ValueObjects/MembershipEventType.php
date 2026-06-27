<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Membership\ValueObjects;

final class MembershipEventType
{
    public const ACTIVATED =
        'membership_activated';

    public const RENEWED =
        'membership_renewed';

    public const EXPIRED =
        'membership_expired';

    public const CANCELLED =
        'membership_cancelled';

    public const PAYMENT_CREATED =
        'payment_created';

    public const PAYMENT_PENDING =
        'payment_pending';

    public const PAYMENT_COMPLETED =
        'payment_completed';

    public const PAYMENT_FAILED =
        'payment_failed';

    public const PAYMENT_REFUNDED =
        'payment_refunded';

    public const PAYMENT_CANCELLED =
        'payment_cancelled';

    /**
     * @return string[]
     */
    public static function all(): array
    {
        return [
            self::ACTIVATED,
            self::RENEWED,
            self::EXPIRED,
            self::CANCELLED,
            self::PAYMENT_CREATED,
            self::PAYMENT_PENDING,
            self::PAYMENT_COMPLETED,
            self::PAYMENT_FAILED,
            self::PAYMENT_REFUNDED,
            self::PAYMENT_CANCELLED,
        ];
    }

    public static function isValid(
        string $eventType
    ): bool {
        return in_array(
            $eventType,
            self::all(),
            true
        );
    }

    private function __construct()
    {
    }
}
