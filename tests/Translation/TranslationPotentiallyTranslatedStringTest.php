<?php

namespace Illuminate\Tests\Translation;

use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Translation\Translator;
use PHPUnit\Framework\TestCase;

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
        $this->assertSame('world', (string) $translation);
    }

    public function testPotentiallyTranslatedStringWithReplacement()
    {
        $translator = new Translator(tap(new ArrayLoader)->addMessages('en', 'custom', [
            'message' => 'hello :recipient',
        ]), 'en');
        $translation = new PotentiallyTranslatedString('custom.message', $translator);
        $translation->translate([ 'recipient' => 'world' ]);
        $this->assertSame('hello world', (string) $translation);
    }

    public function testPotentiallyTranslatedStringWithoutFallback()
    {
        $translator = new Translator(tap(new ArrayLoader)->addMessages('en', 'custom', [
            'hello' => 'world',
        ]), 'en');
        $translation = new PotentiallyTranslatedString('custom.hello', $translator);
        $translation->translate(locale: 'de');
        $this->assertSame('custom.hello', (string) $translation);
    }

    public function testPotentiallyTranslatedStringWithFallback()
    {
        $translator = new Translator(tap(new ArrayLoader)->addMessages('en', 'custom', [
            'hello' => 'world',
        ]), 'en');
        $translator->setFallback('en');
        $translation = new PotentiallyTranslatedString('custom.hello', $translator);
        $translation->translate(locale: 'de');
        $this->assertSame('world', (string) $translation);
    }
}
