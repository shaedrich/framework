<?php

namespace Illuminate\Support;

use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Dumpable;
use Illuminate\Support\Traits\ForwardsCalls;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Support\Traits\Tappable;
use InvalidArgumentException;
use Stringable;

/**
 * @method bool isInt()
 * @method bool isFloat()
 * @method float ceil()
 * @method float floor()
 * @method float round(int $precision = 0, int $mode = PHP_ROUND_HALF_UP)
 * @method bool isFinite()
 * @method bool isInfinite()
 * @method bool isNan()
 * @mixin \Illuminate\Support\Number
 */
class Numberable implements Stringable
{
    use Conditionable, Dumpable, Macroable, Tappable, ForwardsCalls;

    private const BUILTIN_FUNCTIONS = [
        'is_int', 'is_float',
        'ceil', 'floor', 'round',
        'is_finite', 'is_infinite',
        'is_nan',
    ];

    /**
     * The current default locale.
     *
     * @var string
     */
    protected static $locale = 'en';

    public function __construct(
        protected int|float $value,
        protected int $base = 10,
    ) {
        //
    }

    public static function fromString(Stringable $value): self
    {
        dump(input: $value);
        $sanitized = filter_var(
            $value,
            FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_THOUSAND | FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_SCIENTIFIC | FILTER_NULL_ON_FAILURE,
        ) ?? throw new InvalidArgumentException("Value passed cannot be sanitized as a number");
        dump(sanitized: $sanitized);
        $float = filter_var(
            $sanitized,
            FILTER_VALIDATE_FLOAT, 
            FILTER_FLAG_ALLOW_THOUSAND | FILTER_NULL_ON_FAILURE,
        ) ?? throw new InvalidArgumentException("Value passed cannot be validated as a number");
        $int = filter_var(
            $sanitized,
            FILTER_VALIDATE_INT, 
            FILTER_FLAG_ALLOW_THOUSAND | FILTER_FLAG_ALLOW_OCTAL | FILTER_FLAG_ALLOW_HEX | FILTER_NULL_ON_FAILURE,
        );
        dump(float: $float, int: $int);
        return new self($int ?? $float);
    }

    public static function of(int|float|string $value): self
    {
        if (is_string($value)) {
            return self::fromString($value);
        }

        return self
    }

    public static function fromInt(int|string $value): self
    {
        if (is_int($value)) {
            return new self($value);
        }
    }

    public static function fromFloat(): self
    {
        //
    }

    public static function fromBin(Stringable $value): self
    {
        return new self($value, 2); // TODO: num
    }

    public static function fromOct(Stringable $value): self
    {
        return new self($value, 8); // TODO: num
    }

    public static function fromHex(Stringable $value): self
    {
        return new self($value, 16); // TODO: num
    }

    public static function fromScientific(): self
    {
        //
    }

    public function toBase(int $toBase): string
    {
        return base_convert($this->value, $this->base, $toBase);
    }

    public function value(): int|float
    {
        return $this->value;
    }

    /**
     * Execute the given callback using the given locale.
     *
     * @param  string  $locale
     * @param  callable  $callback
     * @return mixed
     */
    public static function withLocale(string $locale, callable $callback)
    {
        $previousLocale = static::$locale;

        static::useLocale($locale);

        return tap($callback(), fn () => static::useLocale($previousLocale));
    }

    /**
     * Set the default locale.
     *
     * @param  string  $locale
     * @return void
     */
    public static function useLocale(string $locale)
    {
        static::$locale = $locale;
    }

    public function __toString(): string
    {
        return Number::format($this->value);
    }

    public function __call($method, $parameters)
    {
        if (in_array($snake = Str::snake($method), self::BUILTIN_FUNCTIONS)) {
            return call_user_func($snake, [ $this->value, ...$parameters ]);
        }

        return self::forwardCallTo(Number::class, $method, [ $this->value, ...$parameters ]);
    }
}
