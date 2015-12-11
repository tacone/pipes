<?php

namespace Pipes\Filter;

use Pipes\Concept\Emittable;

trait MapTrait
{
    /**
     * Tranforms each element into something else using a callback
     * (rough equivalent of array_map()).
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
     * @param callable $callback
     *
     * @return \Pipes\Pipe
     */
    public function map(callable $______callback)
    {
        $iterator = $this->getIterator();
        $pipe = $this;

        $reflectionFunction = new \ReflectionFunction($______callback);

        if ($reflectionFunction->isGenerator()) {
            $generator = $______callback;
        } else {
            $generator = function ($iterator) use ($pipe, $______callback) {
                foreach ($iterator as $key => $value) {
                    //                yield $key => $pipe->executeCallback($______callback, true, $value, $key, $iterator);
                    $value = $pipe->executeCallback($______callback, true, $value, $key, $iterator);
                    if ($value instanceof Emittable) {
                        if ($value->hasKey()) {
                            $key = $value->getKey();
                        }
                        $value = $value->getValue();
                    }
                    yield $key => $value;
                }
            };
        }

        return $this->chainWith($generator($iterator));
//        return $this->chainWith(new \Pipes\Iterator\MapIterator($this->toIterator(), $callback));
    }
}
