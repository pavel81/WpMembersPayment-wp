<?php

declare(strict_types=1);

namespace Panda\WpMembersPay\Localization;

final class LanguageSwitcher
{
    public function getAvailableLanguages(): array
    {
        return [
            'cs_CZ' => 'Čeština',
            'en_US' => 'English',
            'de_DE' => 'Deutsch',
        ];
    }

    public function getCurrentLanguage(): string
    {
        return determine_locale();
    }

    public function isSupported(
        string $locale
    ): bool {
        return array_key_exists(
            $locale,
            $this->getAvailableLanguages()
        );
    }
}
