<?php

namespace Pipes\Filter;

trait FilterTrait
{
    public function filter(callable $callback)
    {
        return new static( new \CallbackFilterIterator($this->getIterator(), $callback));
    }
}