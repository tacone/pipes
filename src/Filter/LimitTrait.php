<?php

namespace Pipes\Filter;

trait LimitTrait
{
    public function limit($num1, $num2 = false)
    {
        if (func_num_args() == 1 || $num2 == false)
        {
            return new static( new \LimitIterator($this->getIterator(), 0, $num1));
        } else {
            return new static( new \LimitIterator($this->getIterator(), $num1, $num2));
        }
        
        
    }
}
