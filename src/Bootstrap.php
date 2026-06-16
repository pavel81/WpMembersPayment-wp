<?php
register_activation_hook(
    __FILE__,
    static function (): void {
        global $wpdb;

        $schemaManager = new \Panda\WpMembersPay\Database\SchemaManager(
            $wpdb
        );

        $schemaManager->install();
    }
);
?>
