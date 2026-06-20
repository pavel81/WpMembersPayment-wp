namespace Panda\WpMembersPay\Integrations\Contracts;

interface TranslationProviderInterface
{
    public function translate(
        string $text,
        string $sourceLocale,
        string $targetLocale
    ): string;
}
