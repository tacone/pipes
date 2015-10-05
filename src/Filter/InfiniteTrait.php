<?php

namespace Pipes\Filter;

trait InfiniteTrait
{

    /***
     * Turns the pipe into an infinite stream by auto rewinding once it reachs
     * the end.
     *
     * WARNING: toArray() will lead to an infinite loop if there is no limit()
     * or other flow interrupting operations *after* infinite()
     *
     * @return mixed
     */

    public function infinite()
    {
        return $this->chainWith(new \InfiniteIterator($this->toIterator()));
    }
}
