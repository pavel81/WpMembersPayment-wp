<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Admin\Membership\Renderers;

use Panda\WpMembersPay\Admin\Membership\ViewModels\EventsViewModel;
use RuntimeException;

final class EventsRenderer
{
    public function render(
        EventsViewModel $viewModel
    ): void {
        $template = __DIR__
            . '/../Templates/events-list.php';

        if (! is_file($template)) {
            throw new RuntimeException(
                'Events template not found.'
            );
        }

        require $template;
    }
}
