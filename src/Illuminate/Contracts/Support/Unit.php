<?php

namespace Illuminate\Contracts\Support;

interface Unit
{
    /**
     * @return array{string, int|float}
     */
    public function increment(): array;

    /**
     * @return array{string, int|float}
     */
    public function decrement(): array;

    public function getBaseUnit(): string;
}
