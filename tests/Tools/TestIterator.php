<?php


namespace Pipes\Test\Tools;


use ArrayIterator;

class TestIterator extends \IteratorIterator
{
    var $key = 0;

    public function __construct($iterator = null)
    {
        if (is_array($iterator)) {
            $iterator = new ArrayIterator($iterator);
        }
        parent::__construct($iterator);
    }

    public function current()
    {
        echo $this->key . ') ' . __METHOD__ . PHP_EOL;
        return parent::current();
    }

    public function next()
    {
        echo $this->key . ') ' . __METHOD__ . PHP_EOL;
        $this->key++;
        parent::next();
    }

    public function key()
    {
        echo $this->key . ') ' . __METHOD__ . PHP_EOL;
        return parent::key();
    }

    public function valid()
    {
        echo $this->key . ') ' . __METHOD__ . PHP_EOL;
        return parent::valid();
    }

    public function rewind()
    {
        parent::rewind();
        $this->key = 0;
    }


}