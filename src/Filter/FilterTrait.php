<?php

namespace Pipes\Filter;

trait FilterTrait
{
    public function filter(callable $callback)
    {
        return $this->chainWith(new \CallbackFilterIterator($this->getIterator(), $callback));
    }
}