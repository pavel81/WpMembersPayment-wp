<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Admin\Membership\Screens;

use Panda\WpMembersPay\Admin\Membership\Renderers\PaymentsRenderer;
use Panda\WpMembersPay\Admin\Membership\ViewModels\PaymentsViewModel;
use Panda\WpMembersPay\Membership\Services\MembershipPaymentService;

final class PaymentsScreen
{
    public function __construct(
        private readonly MembershipPaymentService $paymentService,
        private readonly PaymentsRenderer $renderer,
    ) {
    }

    public function render(): void
    {
        if (! current_user_can('manage_options')) {
            wp_die(
                esc_html__(
                    'Access denied.',
                    'wp-members-pay'
                )
            );
        }

        $viewModel = new PaymentsViewModel(
            payments: $this->paymentService->findAll()
        );

        $this->renderer->render(
            $viewModel
        );
    }
}
