<?php

use Closure;
use Illuminate\Support\HigherOrderWhenProxy;

if (! function_exists('when')) {
    /**
     * Apply the callback if the given "value" is (or resolves to) truthy.
     *
     * @template TWhenParameter
     * @template TWhenReturnType
     *
     * @param  (\Closure(): TWhenParameter)|TWhenParameter|null  $value
     * @param  (callable(TWhenParameter): TWhenReturnType)|null  $callback
     * @param  (callable(TWhenParameter): TWhenReturnType)|null  $default
     * @return TWhenParameter|null|TWhenReturnType
     */
    function when($value = null, ?callable $callback = null, ?callable $default = null)
    {
        $value = $value instanceof Closure ? $value() : $value;

        if (func_num_args() === 0) {
            return new HigherOrderWhenProxy();
        }

        if (func_num_args() === 1) {
            return (new HigherOrderWhenProxy())->condition($value);
        }

        if ($value) {
            return $callback($value) ?? $value;
        } elseif ($default) {
            return $default($value) ?? $value;
        }

        return $value;
    }

    /**
     * Apply the callback if the given "value" is (or resolves to) falsy.
     *
     * @template TUnlessParameter
     * @template TUnlessReturnType
     *
     * @param  (\Closure(): TUnlessParameter)|TUnlessParameter|null  $value
     * @param  (callable(TUnlessParameter): TUnlessReturnType)|null  $callback
     * @param  (callable(TUnlessParameter): TUnlessReturnType)|null  $default
     * @return TWhenParameter|null|TUnlessReturnType
     */
    function unless($value = null, ?callable $callback = null, ?callable $default = null)
    {
        $value = $value instanceof Closure ? $value() : $value;

        if (func_num_args() === 0) {
            return (new HigherOrderWhenProxy())->negateConditionOnCapture();
        }

        if (func_num_args() === 1) {
            return (new HigherOrderWhenProxy())->condition(! $value);
        }

        if (! $value) {
            return $callback($this, $value) ?? $value;
        } elseif ($default) {
            return $default($this, $value) ?? $value;
        }

        return $value;
    }
}
