<?php

namespace Pipes\Filter;

trait SkipTrait
{
    public function skip($num)
    {
        return $this->chainWith(new \Pipes\Iterator\SkipIterator($this->getIterator(), $num));
    }
}