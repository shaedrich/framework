<?php

namespace Illuminate\Tests\Translation;

use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Translation\Translator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\TestWith;

class TranslationPotentiallyTranslatedStringTest extends TestCase
{
    public function testPotentiallyTranslatedStringTranslation()
    {
        $translator = new Translator(tap(new ArrayLoader)->addMessages('en', 'custom', [
            'hello' => 'world',
            'lorem' => 'ipsum',
        ]), 'en');
        $translation = new PotentiallyTranslatedString('custom.hello', $translator);
        $translation->translate();
        $this->assertSame('world', (string)$translation);
    }

    #[TestWith(['custom.hello', 'en', true])]
    #[TestWith(['basic.hello', 'en', false])]
    #[TestWith(['custom.world', 'en', false])]
    #[TestWith(['custom.hello', 'de', false])]
    public function testPotentiallyTranslatedStringExistenceCheck(string $key, string $locale, bool $exists)
    {
        $translator = new Translator(tap(new ArrayLoader)->addMessages('en', 'custom', [
            'hello' => 'world',
            'lorem' => 'ipsum',
        ]), 'en');
        $translation = new PotentiallyTranslatedString($string, $translator);
        dd($exists, $translator->has($key), $translator->hasForLocale($key, $locale), $translation->has(), $translation->hasForLocale($locale));
        $this->assertSame($exists, $translation->hasForLocale($locale));
    }
}
