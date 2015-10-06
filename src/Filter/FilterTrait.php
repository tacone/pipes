<?php

namespace Pipes\Filter;

trait FilterTrait
{
    /**
     * Filters elements with a callback
     * (internally uses \CallbackFilterIterator).
     *
     * Only the elements for which the callback evaluates to TRUE
     * will be used
     *
     * @param callable $callback
     *
     * @return \Pipes\Pipe
     */
    public function filter(callable $callback)
    {
        return $this->chainWith(new \CallbackFilterIterator($this->toIterator(), $callback));
    }
}
