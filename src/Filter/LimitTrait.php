<?php

namespace Pipes\Filter;

trait LimitTrait
{
    /**
     * Return only a subset of items. Behaves similarly to MYSQL's
     * "LIMIT" clause.
     * (internally uses \LimitIterator)
     *
     *  <code>p()->limit(5)</code> will return only the first five elements.
     *  <code>p()->limit(2, 5)</code> will skip 2 element, and return the next 5.
     *
     * @param $boundary1
     * @param  bool        $boundary2
     * @return \Pipes\Pipe
     */
    public function limit($boundary1, $boundary2 = false)
    {
        if (func_num_args() == 1 || $boundary2 === false) {
            $offset = 0;
            $count = $boundary1;
        } else {
            $offset = $boundary1;
            $count = $boundary2;
        }
        if (!$count) {
            return $this->chainWith(new \ArrayIterator([]));
        }

        return $this->chainWith(new \LimitIterator($this->toIterator(), $offset, $count));
    }
}
