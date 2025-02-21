<?php

namespace Illuminate\Tests\Support;

use Illuminate\Support\Numberable;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class SupportNumberableTest extends TestCase
{
    #[DataProvider('providesInts')]
    public function testIsInt(int|float $number, bool $isInt)
    {
        var_dump($number, new Numberable($number));
        $this->assertSame((new Numberable($number))->isInt(), $isInt);
    }

    public static function providesInts(): array
    {
        return [
            'is an int' => [ 1, true ],
            'is not an int' => [ 1.1, false ],
        ];
    }
    #[DataProvider('providesNumericStrings')]
    public function testParsing(string $number, bool $isValid)
    {
        if (!$isValid) {
            $this->expectException(InvalidArgumentException::class);
        }
        var_dump($number, Numberable::fromString($number));
        $this->assertSame(Numberable::fromString($number)->value(), (float)$number);
    }

    public static function providesNumericStrings(): array
    {
        return [
            'is valid int' => [ '1', true ],
            'is valid float' => [ '1.1', true ],
            'is valid thousand' => [ '1,100', true ],
            'is invalid arbitrary string' => [ 'gibberish', false ],
        ];
    }
}
