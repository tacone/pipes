<?php

namespace Pipes;

use IteratorAggregate;
use Pipes\Iterator\PlainArrayIterator;

class Pipe implements IteratorAggregate
{
    use PipenessTrait;

    protected $var;

    public function __construct(&$var = null)
    {
        if (is_array($var)) {
            $this->var = new PlainArrayIterator($var);
        }
        if ($var instanceof \Traversable) {
            $this->var = $var;
        }
        if (!func_num_args()) {
            $this->var = [];
        }
    }

    /**
     * This method is implemented just because it's required by the
     * \IteratorAggregate interface.
     *
     * Returns an instance of the last array/Traversable of the chain
     * Don't use this method: it won't return a Pipe instance:
     * no more chaining magic.
     * It may very well be a plain array.
     *
     * If you need an iterator, use toIterator() instead.
     *
     * @return array|\Traversable
     */
    public function getIterator()
    {
        return $this->var;
    }
}
