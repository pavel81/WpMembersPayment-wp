<?php

declare(strict_types=1);

/** @var \Panda\WpMembersPay\Admin\Membership\ViewModels\EventsViewModel $viewModel */

?>

<div class="wrap">

    <h1>
        Membership Events
    </h1>

    <table class="widefat striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Membership ID</th>
                <th>Event Type</th>
                <th>Created</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach ($viewModel->events as $event) : ?>

            <tr>
                <td>
                    <?php echo esc_html((string) $event->id); ?>
                </td>

                <td>
                    <?php echo esc_html((string) $event->membershipId); ?>
                </td>

                <td>
                    <?php echo esc_html($event->eventType); ?>
                </td>

                <td>
                    <?php echo esc_html((string) $event->createdAt); ?>
                </td>
            </tr>

        <?php endforeach; ?>

        </tbody>
    </table>

</div>
