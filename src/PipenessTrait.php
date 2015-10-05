<?php

namespace Pipes;

use Pipes\Iterator\AppendIterator;
use Pipes\Test\PipeIterationTest;

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
    use Filter\SleepTrait;
    use Filter\InfiniteTrait;

    /**
     * @param  \Iterator $iterator
     * @return static
     */
    protected function chainWith(\Iterator $iterator)
    {
//        if (is_a($iterator, "\\Pipes\\PipeIterator")) {
//            return p($iterator)->toIterator();
//        }
        $this->var = $iterator;
        return $this;
    }

    public function toArray()
    {
//        if (is_a($this, "\\IteratorAggregate"))
//        {
            $iterator = $this->var;
//        } else {
//            $iterator = $this;
//        }

        return iterator_to_array($iterator, true);
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
        $iterator = $this->unwrap();

        if (is_array($iterator)) {
            $iterator = new \ArrayIterator($iterator);
        }

        $appendIterator = new AppendIterator();
        $appendIterator->append($iterator);

        return new PipeIterator($appendIterator);
    }


    /**
     * @return \Traversable
     */
    protected function getRoot()
    {
        return $this->getBaseOfChain($this,true);
    }

    /**
     * Returns the latest non pipe Iterator/Traversable in the
     * chain
     *
     * @return \Traversable
     */
    public function unwrap()
    {
        $iterator = func_num_args() ? func_get_arg(0) : $this;

        return $this->getBaseOfChain($iterator);
    }

    public function getBaseOfChain($iterator, $pipeInstance = false)
    {
        $last = $iterator;
        while (true) {
            switch (true) {
                case is_a($iterator, "\\Pipes\\PipeIterator"):
                    $last = $iterator;
                    $iterator = $last->getInnerIterator();
                    break;
                case is_a($iterator, "\\Pipes\\Pipe"):
                    $last = $iterator;
                    $iterator = $last->getIterator();
                    break;
                case is_a($iterator, "\\ArrayIterator"):
                    $iterator = $iterator->getArrayCopy();
                    break;
                default:
                    if ($pipeInstance) {
                        return $last;
                    }
                    return $iterator;
            }
        }
    }
}
