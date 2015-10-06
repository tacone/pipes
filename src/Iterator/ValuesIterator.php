<?php

/**
 * Derived by Guzzle's ChunkedIterator https://github.com/guzzle/iterator/blob/master/ChunkedIterator.php
 * credit goes to the original authors.
 */
namespace Pipes\Iterator;

class ValuesIterator extends \IteratorIterator
{
    protected $key = 0;

    public function rewind()
    {
        parent::rewind();
        $this->key = 0;
    }

    public function key()
    {
        return $this->key;
    }

    public function next()
    {
        parent::next();
        ++$this->key;
    }
}
