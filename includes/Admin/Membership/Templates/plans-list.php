<?php

declare(strict_types=1);

/** @var \Panda\WpMembersPay\Admin\Membership\ViewModels\PlansViewModel $viewModel */

?>

<div class="wrap">

    <h1>Membership Plans</h1>

    <table class="widefat striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Price</th>
                <th>Duration</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach ($viewModel->plans as $plan) : ?>

            <tr>
                <td><?php echo esc_html((string) $plan->id); ?></td>
                <td><?php echo esc_html($plan->name); ?></td>
                <td><?php echo esc_html($plan->slug); ?></td>
                <td>
                    <?php echo esc_html(number_format($plan->price, 2)); ?>
                    <?php echo esc_html($plan->currency); ?>
                </td>
                <td><?php echo esc_html((string) $plan->durationDays); ?> days</td>
                <td><?php echo $plan->isActive ? 'Active' : 'Inactive'; ?></td>
            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>
