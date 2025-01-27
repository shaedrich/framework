<?php

namespace Illuminate\Support;

use Stringable;

class UnitValue implements Stringable
{
    public function __construct(
        public readonly mixed $unit,
        public readonly int|float $value,
    ) {}

    public function __toString()
    {
        return $this->value.$this->unit;
    }
}

