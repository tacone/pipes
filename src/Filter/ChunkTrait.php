<?php

namespace Pipes\Filter;

trait ChunkTrait
{
    public function chunk($num)
    {
        return $this->chainWith(new \Pipes\Iterator\ChunkIterator($this->getIterator(), $num));
    }
}