<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\Security;

use Panda\WpMembersPay\Payments\Services\SecurityEventService;

final class ReplayProtection
{
    /**
     * @var array<string,bool>
     */
    private array $processedEvents = [];

    public function __construct(
        private readonly SecurityEventService $securityEventService,
    ) {
    }

    public function isProcessed(
        string $eventId
    ): bool {
        $processed = isset(
            $this->processedEvents[$eventId]
        );

        if ($processed) {
            $this->securityEventService->create(
                SecurityEventType::REPLAY_ATTACK,
                $_SERVER['REMOTE_ADDR'] ?? 'unknown',
                $eventId
            );
        }

        return $processed;
    }

    public function markProcessed(
        string $eventId
    ): void {
        $this->processedEvents[$eventId] = true;
    }
}
