<?php

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

if (! defined('PWMP_VERSION')) {
    define('PWMP_VERSION', '1.0.0');
}

if (! defined('PWMP_PATH')) {
    define('PWMP_PATH', __DIR__);
}

if (! defined('PWMP_URL')) {
    define(
        'PWMP_URL',
        plugin_dir_url(__FILE__)
    );
}

if (! defined('PWMP_FILE')) {
    define(
        'PWMP_FILE',
        __FILE__
    );
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/bootstrap.php';
