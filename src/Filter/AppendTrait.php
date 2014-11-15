<?php

namespace Pipes\Filter;

use Pipes\Iterator\AppendIterator;

trait AppendTrait
{
    /**
     * Adds an iterator to the queue
     *
     * @param array|\Iterator
     * @return \Pipes\Pipe
     */
    public function append($iterator)
    {
        if (is_array($iterator))
        {
            $iterator = new \ArrayIterator($iterator);
        }
        $appendIterator = new AppendIterator();
        $appendIterator->append($this->getIterator());
        $appendIterator->append($iterator);
        return $this->chainWith($appendIterator);
    }
}