<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Admin\Membership\Renderers;

use Panda\WpMembersPay\Admin\Membership\ViewModels\PaymentsViewModel;
use RuntimeException;

final class PaymentsRenderer
{
    public function render(
        PaymentsViewModel $viewModel
    ): void {
        $template = __DIR__
            . '/../Templates/payments-list.php';

        if (! is_file($template)) {
            throw new RuntimeException(
                'Payments template not found.'
            );
        }

        require $template;
    }
}
