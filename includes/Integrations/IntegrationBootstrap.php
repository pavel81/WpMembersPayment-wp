<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Integrations;

use Panda\WpMembersPay\Container\ServiceContainer;

final class IntegrationBootstrap
{
    public function __construct(
        private readonly ServiceContainer $container,
    ) {
    }

    public function boot(): void
    {
        do_action(
            'pwmp_translation_provider_loaded',
            $this->container
        );
    }
}
