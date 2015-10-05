<?php

namespace Pipes\Filter;

use Pipes\Iterator\AppendIterator;

trait AppendTrait
{

    public function append($iterator)
    {
        if (is_array($iterator)) {
            $iterator = new \ArrayIterator($iterator);
        }

        $me = $this;
        while (is_a($me, "\\Pipes\\PipeIterator")) {
            $me = $me->getInnerIterator();
        }

        if (is_a($me, "\\Pipes\\Iterator\\AppendIterator")) {
            $appendIterator = $me;
        } else {
            $appendIterator = new AppendIterator();
            $appendIterator->append($me->toIterator());
        }

        $appendIterator->append($iterator);

        return $this->getRoot()->chainWith($appendIterator);
    }
}
