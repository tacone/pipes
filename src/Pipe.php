<?php

namespace pipes;

use ArrayIterator;
use IteratorAggregate;

class Pipe  implements IteratorAggregate
{

    protected $var;

    function __construct($var)
    {
        $this->var = $var;
    }
    public function toArray()
    {
//        return $this->getArrayCopy();
        return $this->var;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->var);
    }

}
