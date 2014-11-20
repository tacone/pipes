<?php

namespace Pipes;

use ArrayIterator;
use IteratorAggregate;

class Pipe implements IteratorAggregate
{
    use Filter\AppendTrait;
    use Filter\ChunkTrait;
    use Filter\EachTrait;
    use Concept\EmitTrait;
    use Filter\FilesTrait;
    use Filter\FilterTrait;
    use Filter\LimitTrait;
    use Filter\MapTrait;
    use Filter\SkipTrait;
    use Filter\ValuesTrait;

    protected $var;

    public function __construct(&$var = null)
    {
        if (is_array($var)) {
            $this->var = new ArrayIterator($var);
        }
        if ($var instanceof \Traversable) {
            $this->var = $var;
        }
        if (!func_num_args()) $this->var = [];
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

    public function toArray()
    {
        return iterator_to_array($this->var, true);
    }

    /**
     * Returns a complete iterator.
     * (an instance of \IteratorIterator which in turn
     * implements \OuterIterator)
     *
     * Use this method if you need to comply with type-hinting
     * from external libraries
     *
     * @return \IteratorIterator
     */
    public function toIterator()
    {
        return new \IteratorIterator($this);
    }

    /**
     * @param  \Iterator $iterator
     * @return static
     */
    protected function chainWith(\Iterator $iterator)
    {
//        return new static($iterator);
        $this->var = $iterator;
        return $this;
    }

}
