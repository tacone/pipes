<?php

namespace Pipes\Filter;

trait MapTrait
{
    /**
     * Tranforms each element into something else using a callback
     * (rough equivalent of array_map())
     *
     * The callback should return the new element.
     *
     * To also change the key, return<code>p()->emit($key,$value)</code>
     * <code>
     * p()->map(function ($value, $key, $iterator) {
     *     return p()->emit($key.'_new', $value);
     * });
     *
     *
     * @param  callable    $callback
     * @return \Pipes\Pipe
     */
    public function map(callable $callback)
    {
        return $this->chainWith(new \Pipes\Iterator\MapIterator($this->toIterator(), $callback));
    }
}
