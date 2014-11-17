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

    function __construct($var = null)
    {
        if (is_array($var)) {
            $this->var = new ArrayIterator($var);
        }
        if ($var instanceof \Traversable) {
            $this->var = $var;
        }
        if (!func_num_args()) $this->var = [];
    }

    public function toArray()
    {
        return iterator_to_array($this->var, true);
    }

    public function getIterator()
    {
        return $this->var;
    }

    /**
     * @param \Iterator $iterator
     * @return static
     */
    protected function chainWith(\Iterator $iterator)
    {
        return new static($iterator);
    }

}
