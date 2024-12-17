<?php

namespace Illuminate\Support\Defer;

use ArrayAccess;
use Closure;
use Countable;
use Illuminate\Support\Traits\CollectionArrayAccess;
use Illuminate\Support\Traits\CountCollection;


/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 */
class DeferredCallbackCollection implements ArrayAccess, Countable
{
    /**
     * @use \Illuminate\Support\Traits\CollectionArrayAccess<TKey, TValue>
     */
    use CountCollection, CollectionArrayAccess {
        CountCollection::count as private _count;
        CollectionArrayAccess::offsetExists as private _exists;
        CollectionArrayAccess::offsetGet as private _get;
        CollectionArrayAccess::offsetUnset as private _unset;
    }

    /**
     * All of the deferred callbacks.
     *
     * @var array
     */
    protected array $items = [];

    /**
     * Get the first callback in the collection.
     *
     * @return callable
     */
    public function first()
    {
        return array_values($this->items)[0];
    }

    /**
     * Invoke the deferred callbacks.
     *
     * @return void
     */
    public function invoke(): void
    {
        $this->invokeWhen(fn () => true);
    }

    /**
     * Invoke the deferred callbacks if the given truth test evaluates to true.
     *
     * @param  \Closure|null  $when
     * @return void
     */
    public function invokeWhen(?Closure $when = null): void
    {
        $when ??= fn () => true;

        $this->forgetDuplicates();

        foreach ($this->items as $index => $callback) {
            if ($when($callback)) {
                rescue($callback);
            }

            self::_unset($index);
        }
    }

    /**
     * Remove any deferred callbacks with the given name.
     *
     * @param  string  $name
     * @return void
     */
    public function forget(string $name): void
    {
        $this->items = (new Collection($this->callbacks))
            ->reject(fn ($callback) => $callback->name === $name)
            ->values()
            ->all();
    }

    /**
     * Remove any duplicate callbacks.
     *
     * @return $this
     */
    protected function forgetDuplicates(): self
    {
        $this->callbacks = (new Collection($this->callbacks))
            ->reverse()
            ->unique(fn ($c) => $c->name)
            ->reverse()
            ->values()
            ->all();

        return $this;
    }

    /**
     * Determine if the collection has a callback with the given key.
     *
     * @param  mixed  $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        $this->forgetDuplicates();

        return self::_exists($offset);
    }

    /**
     * Get the callback with the given key.
     *
     * @param  mixed  $offset
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        $this->forgetDuplicates();

        return self::_get($offset);
    }

    /**
     * Remove the callback with the given key from the collection.
     *
     * @param  mixed  $offset
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        $this->forgetDuplicates();

        self::_unset($offset);
    }

    /**
     * Determine how many callbacks are in the collection.
     *
     * @return int
     */
    public function count(): int
    {
        $this->forgetDuplicates();

        return self::_count();
    }
}
