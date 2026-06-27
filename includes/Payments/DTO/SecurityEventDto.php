<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Payments\DTO;

final readonly class SecurityEventDto
{
    public function __construct(
        public ?int $id,
        public string $eventType,
        public string $ipAddress,
        public ?string $referenceKey = null,
        public ?string $payload = null,
        public ?string $createdAt = null,
    ) {
    }
}
