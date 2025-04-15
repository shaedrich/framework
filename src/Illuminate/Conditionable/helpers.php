<?php

use Closure;

if (! function_exists('when')) {
    /**
     * Apply the callback if the given "value" is (or resolves to) truthy.
     *
     * @template TWhenParameter
     * @template TWhenReturnType
     *
     * @param  (\Closure(): TWhenParameter)|TWhenParameter  $value
     * @param  (callable(TWhenParameter): TWhenReturnType)  $callback
     * @param  (callable(TWhenParameter): TWhenReturnType)|null  $default
     * @return TWhenParameter|TWhenReturnType
     */
    function when($value, callable $callback, ?callable $default = null)
    {
        $value = $value instanceof Closure ? $value() : $value;

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
     * @param  (\Closure(): TUnlessParameter)|TUnlessParameter  $value
     * @param  (callable(TUnlessParameter): TUnlessReturnType)  $callback
     * @param  (callable(TUnlessParameter): TUnlessReturnType)|null  $default
     * @return TWhenParameter|TUnlessReturnType
     */
    function unless($value, callable $callback, ?callable $default = null)
    {
        $value = $value instanceof Closure ? $value() : $value;

        if (! $value) {
            return $callback($this, $value) ?? $value;
        } elseif ($default) {
            return $default($this, $value) ?? $value;
        }

        return $value;
    }
}
