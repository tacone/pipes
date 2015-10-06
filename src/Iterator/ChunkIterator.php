<?php

/**
 * Derived by Guzzle's ChunkedIterator https://github.com/guzzle/iterator/blob/master/ChunkedIterator.php
 * credit goes to the original authors.
 */
namespace Pipes\Iterator;

use Traversable;

class ChunkIterator extends \IteratorIterator
{
    protected $key = 0;

    /** @var int Size of each chunk */
    protected $size;
    /** @var array Current chunk */
    protected $chunk;

    /**
     * @param Traversable $iterator Traversable iterator
     * @param int         $size     Size to make each chunk
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(Traversable $iterator, $size)
    {
        $size = (int) $size;
        if ($size < 0) {
            throw new \InvalidArgumentException("The chunk size must be equal or greater than zero; $size given");
        }
        parent::__construct($iterator);
        $this->size = $size;
    }

    public function rewind()
    {
        parent::rewind();
        $this->next();
        $this->key = 0;
    }

    public function next()
    {
        $this->chunk = array();
        for ($i = 0; $i < $this->size && parent::valid(); ++$i) {
            $this->chunk[] = parent::current();
            parent::next();
        }
        $this->chunk ? $this->key++ : null;
    }

    public function key()
    {
        return $this->key;
    }

    public function current()
    {
        return $this->chunk;
    }

    public function valid()
    {
        return (bool) $this->chunk;
    }
}
