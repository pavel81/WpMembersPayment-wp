<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Admin\Membership\Screens;

use Panda\WpMembersPay\Admin\Membership\Renderers\PlansRenderer;
use Panda\WpMembersPay\Admin\Membership\ViewModels\PlansViewModel;
use Panda\WpMembersPay\Membership\Services\MembershipPlanService;

final class PlansScreen
{
    public function __construct(
        private readonly MembershipPlanService $planService,
        private readonly PlansRenderer $renderer,
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

        $viewModel = new PlansViewModel(
            plans: $this->planService->findAll()
        );

        $this->renderer->render(
            $viewModel
        );
    }
}
