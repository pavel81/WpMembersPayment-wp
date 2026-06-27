<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\Security;

use Panda\WpMembersPay\Payments\Services\SecurityEventService;

final class SecurityEventType
{



public function __construct(
    private readonly SecurityEventService $securityEventService,
) {
}
    public const RATE_LIMIT =
        'rate_limit';

    public const INVALID_SIGNATURE =
        'invalid_signature';

    public const INVALID_TIMESTAMP =
        'invalid_timestamp';

    public const INVALID_PAYLOAD =
        'invalid_payload';

    public const REPLAY_ATTACK =
        'replay_attack';

    /**
     * @return string[]
     */
    public static function all(): array
    {
        return [
            self::RATE_LIMIT,
            self::INVALID_SIGNATURE,
            self::INVALID_TIMESTAMP,
            self::INVALID_PAYLOAD,
            self::REPLAY_ATTACK,
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
