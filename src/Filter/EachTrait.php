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
     * @param  callable $callback
     * @return \Pipes\Pipe
     */
    public function each(callable $______callback, $______allArgs = false)
    {
        return $this->chainWith(
            new \CallbackFilterIterator($this->getIterator(),
                function () use ($______callback, $______allArgs
                ) {
                    call_user_func_array($______callback, $______allArgs ? func_get_args() : [func_get_arg(0)]);
                    return true;
                }));
    }
}
