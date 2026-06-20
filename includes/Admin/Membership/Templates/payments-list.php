<?php

declare(strict_types=1);

/** @var \Panda\WpMembersPay\Admin\Membership\ViewModels\PaymentsViewModel $viewModel */

?>

<div class="wrap">

    <h1>
        Membership Payments
    </h1>

    <table class="widefat striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Membership</th>
                <th>Gateway</th>
                <th>Transaction</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach ($viewModel->payments as $payment) : ?>

            <tr>
                <td>
                    <?php echo esc_html((string) $payment->id); ?>
                </td>

                <td>
                    <?php echo esc_html((string) $payment->membershipId); ?>
                </td>

                <td>
                    <?php echo esc_html($payment->paymentGateway); ?>
                </td>

                <td>
                    <?php echo esc_html($payment->transactionId); ?>
                </td>

                <td>
                    <?php
                    echo esc_html(
                        number_format(
                            $payment->amount,
                            2
                        )
                    );
                    ?>
                    <?php echo esc_html($payment->currency); ?>
                </td>

                <td>
                    <?php echo esc_html($payment->status); ?>
                </td>
            </tr>

        <?php endforeach; ?>

        </tbody>
    </table>

</div>
