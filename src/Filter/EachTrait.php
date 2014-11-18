<?php

namespace Pipes\Filter;

trait EachTrait
{
    /**
     * Applies a callback to each element.
     * (internally uses \CallbackFilterIterator)
     *
     * The passed callback will be invoked with the following arguments:
     *      - $value (iterator's current())
     *      - $key (iterator's key())
     *      - $iterator (the iterator itself)
     *
     * @param  callable    $callback
     * @return \Pipes\Pipe
     */
    public function each(callable $______callback)
    {
        return $this->chainWith(new \CallbackFilterIterator($this->getIterator(), function () use ($______callback) {
            call_user_func_array($______callback, func_get_args());

            return true;
        }));
    }
}
