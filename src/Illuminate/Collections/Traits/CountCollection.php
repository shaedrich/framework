<?php

namespace Illuminate\Collections\Traits;

/** 
 * @phpstan-require-implements Countable
 */
trait CountCollection
{
    /**
     * Count the number of items in the collection.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }
}
