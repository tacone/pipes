<?php

namespace Pipes\Filter;

trait EachTrait
{
    /**
     * Applies a callback to each element.
     * (internally uses \CallbackFilterIterator)
     *
     * The passed callback will be invoked with the following argument:
     *
     *      - $value (iterator's current())
     *
     * If the second parameter is true the following arguments will be added
     * to the call:
     *
     *      - $key (iterator's key())
     *      - $iterator (the iterator itself)
     *
     * @param callable $______callback a PHP callable (closure, string or array)
     * @param bool $______allArgs if true key and iterator will be passed to the callback
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
