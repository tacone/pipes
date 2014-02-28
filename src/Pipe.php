<?php

namespace Pipes;

use ArrayIterator;
use IteratorAggregate;

class Pipe implements IteratorAggregate
{

    use Filter\FilterTrait;

    protected $var;

    function __construct($var)
    {
        if (is_array($var)) {
            $this->var = new ArrayIterator($var);
        }
        if ($var instanceof \Traversable) {
            $this->var = $var;
        }
    }

    public function toArray()
    {
        return iterator_to_array($this->var, true);
    }

    public function getIterator()
    {
        return $this->var;
    }

}
