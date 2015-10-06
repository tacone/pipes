<?php

namespace Pipes\Filter;

trait SkipTrait
{
    /**
     * Discards the first $num elements.
     *
     * @param $num
     *
     * @return \Pipes\Pipe
     */
    public function skip($num)
    {
        return $this->chainWith(new \Pipes\Iterator\SkipIterator($this->getIterator(), $num));
    }
}
