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
        if (is_array($iterator)) {
            $iterator = new \ArrayIterator($iterator);
        }
        if (is_a($this,"\\Pipes\\PipeIterator"))
        {
            $appendIterator = $this->getInnerIterator();
        } else {
            $appendIterator = new AppendIterator();
            $appendIterator->append($this->unwrap());
        }

        $appendIterator->append($iterator);

        return $this->getRoot()->chainWith($appendIterator);
    }
}
