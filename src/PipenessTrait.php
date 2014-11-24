<?php

namespace Pipes;

use ArrayIterator;
use IteratorAggregate;

trait PipenessTrait
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
        $this->initialize($var);
    }

    protected function initialize(&$var)
    {
        if (is_array($var)) {
            $this->var = new ArrayIterator($var);
        }
        if ($var instanceof \Traversable) {
            $this->var = $var;
        }
        if (!func_num_args()) {
            $this->var = [];
        }
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
        if (is_a($this, "\Iterator")) {
            return $this;
        }
        return new \IteratorIterator($this);
    }

    /**
     * @param  \Iterator $iterator
     * @return static
     */
    protected function chainWith(\Iterator $iterator)
    {
        $this->var = $iterator;

        return $this;
    }

}
