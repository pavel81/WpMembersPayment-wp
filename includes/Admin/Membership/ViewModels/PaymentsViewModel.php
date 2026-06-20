<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Admin\Membership\ViewModels;

use Panda\WpMembersPay\Membership\DTO\MembershipPaymentDto;

final readonly class PaymentsViewModel
{
    /**
     * @param MembershipPaymentDto[] $payments
     */
    public function __construct(
        public array $payments,
    ) {
    }
}
