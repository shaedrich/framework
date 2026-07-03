<?php

namespace Illuminate\Database\Console\Seeds;

use Illuminate\Database\Eloquent\Model;

trait WithoutModelEvents
{
    /**
     * Prevent model events from being dispatched by the given callback.
     *
     * @template TReturn
     *
     * @param  callable(): TReturn  $callback
     * @param-immediately-invoked-callable  $callback
     * @return TReturn
     */
    public function withoutModelEvents(callable $callback)
    {
        return fn () => Model::withoutEvents($callback);
    }
}
