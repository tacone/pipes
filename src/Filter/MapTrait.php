<?php

namespace Pipes\Filter;

trait MapTrait
{
    public function map(callable $callback)
    {
        return $this->chainWith(new \Pipes\Iterator\MapIterator($this->getIterator(), $callback));
    }
}