<?php

namespace Illuminate\Support;

use Illuminate\Support\Enums\UnitType;
use InvalidArgumentException;
use Stringable;

use function Illuminate\Support\enum_value;

class UnitValue implements Stringable
{
    public readonly string|UnitType $unitType;
    public readonly string $unit; // TODO: unit enums/class from interface

    public function __construct(
        string|UnitType $unitType,
        public readonly int|float $value,
        public readonly int|float|null $fraction = null,
        string $unit, // TODO: unit enums/class from interface
    ) {
        if ($unitType instanceof UnitType) {
            $this->unitType = $unitType;

            if (is_string($unit)) {
                $this->unit = $unit;
            } else {
                // TODO: base unit from unit class
            }
        } else {
            $this->unit = $unitType;
        }

        if (is_float($value) && $fraction !== null) {
            throw new InvalidArgumentException('$fraction can only be used when $value is an integer');
        }
    }

    public function getValue(): int|float
    {
        if (is_float($this->value) || $this->fraction === null) {
            return $this->value;
        }

        return intval($this->value.'.'.$this->fraction);
    }

    public function format()
    {
        return match ($this->unitType) {
            UnitType::Currency => Number::currency($this->getValue()),
            UnitType::FileSize => Number::fileSize($this->getValue()),
            default => $this->getValue().enum_value($this->unit),
        };
    }

    public function __toString()
    {
        return $this->format();
    }
}

