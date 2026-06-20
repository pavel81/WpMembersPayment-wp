<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Admin\Membership\Renderers;

use Panda\WpMembersPay\Admin\Membership\ViewModels\MembershipsViewModel;
use RuntimeException;

final class MembershipsRenderer
{
    public function render(
        MembershipsViewModel $viewModel
    ): void {
        $template = __DIR__
            . '/../Templates/memberships-list.php';

        if (! is_file($template)) {
            throw new RuntimeException(
                'Memberships template not found.'
            );
        }

        require $template;
    }
}
