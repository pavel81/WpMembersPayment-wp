<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Admin\Membership\Screens;

use Panda\WpMembersPay\Admin\Membership\Renderers\MembershipsRenderer;
use Panda\WpMembersPay\Admin\Membership\ViewModels\MembershipsViewModel;
use Panda\WpMembersPay\Membership\Services\MembershipService;

final class MembershipsScreen
{
    public function __construct(
        private readonly MembershipService $membershipService,
        private readonly MembershipsRenderer $renderer,
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

        $viewModel = new MembershipsViewModel(
            memberships: $this->membershipService->findAll()
        );

        $this->renderer->render(
            $viewModel
        );
    }
}
