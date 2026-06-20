<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Admin\Membership\Screens;

use Panda\WpMembersPay\Admin\Membership\Renderers\EventsRenderer;
use Panda\WpMembersPay\Admin\Membership\ViewModels\EventsViewModel;
use Panda\WpMembersPay\Membership\Services\MembershipEventService;

final class EventsScreen
{
    public function __construct(
        private readonly MembershipEventService $eventService,
        private readonly EventsRenderer $renderer,
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

        $viewModel = new EventsViewModel(
            events: $this->eventService->findAll()
        );

        $this->renderer->render(
            $viewModel
        );
    }
}
