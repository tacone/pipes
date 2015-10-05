<?php

namespace Pipes\Filter;

trait InfiniteTrait
{

    /***
     * Turns the pipe into an infinite stream by auto rewinding once it reachs
     * the end.
     *
     * @return mixed
     */

    public function infinite()
    {
        return $this->chainWith(new \InfiniteIterator($this->toIterator()));
    }
}
