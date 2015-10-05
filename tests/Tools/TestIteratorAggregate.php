<?php


namespace Pipes\Test\Tools;


use Traversable;

class TestIteratorAggregate implements \IteratorAggregate
{
    protected $inner;

    public function __construct($var)
    {
        $this->inner = $var;
    }

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
       return $this->inner;
    }
}
