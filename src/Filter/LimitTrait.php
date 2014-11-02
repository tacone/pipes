<?php

namespace Pipes\Filter;

trait LimitTrait
{
    public function limit($num1, $num2 = false)
    {
        if (func_num_args() == 1 || $num2 === false) {
            $offset = 0;
            $count = $num1;
        } else {
            $offset = $num1;
            $count = $num2;
        }
        if (!$count) {
            return $this->chainWith(new \ArrayIterator([]));
        }
        return $this->chainWith(new \LimitIterator($this->getIterator(), $offset, $count));
    }
}
