<?php

namespace Pipes\Filter;

trait MapTrait
{
    public function map(callable $callback)
    {
        return new static( new \Pipes\Iterator\MapIterator($this->getIterator(), $callback));
    }
}