<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Database\Contracts;

interface TableInterface
{
    public const TABLE_NAME = '';

    public static function getSchema(): string;
}
