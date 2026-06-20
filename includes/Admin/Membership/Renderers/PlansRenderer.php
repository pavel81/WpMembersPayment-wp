<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Admin\Membership\Renderers;

use Panda\WpMembersPay\Admin\Membership\ViewModels\PlansViewModel;
use RuntimeException;

final class PlansRenderer
{
    public function render(
        PlansViewModel $viewModel
    ): void {
        $template = __DIR__
            . '/../Templates/plans-list.php';

        if (! is_file($template)) {
            throw new RuntimeException(
                'Plans template not found.'
            );
        }

        require $template;
    }
}
