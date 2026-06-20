<?php

declare(strict_types=1);

/** @var \Panda\WpMembersPay\Admin\Membership\ViewModels\MembershipsViewModel $viewModel */

?>

<div class="wrap">

    <h1>Memberships</h1>

    <table class="widefat striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Plan ID</th>
                <th>Status</th>
                <th>Started</th>
                <th>Expires</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach ($viewModel->memberships as $membership) : ?>

            <tr>
                <td><?php echo esc_html((string) $membership->id); ?></td>
                <td><?php echo esc_html((string) $membership->userId); ?></td>
                <td><?php echo esc_html((string) $membership->planId); ?></td>
                <td><?php echo esc_html($membership->status); ?></td>
                <td><?php echo esc_html($membership->startedAt); ?></td>
                <td><?php echo esc_html($membership->expiresAt); ?></td>
            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>
