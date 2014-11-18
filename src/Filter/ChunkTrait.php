<?php

namespace Pipes\Filter;

trait ChunkTrait
{
    /**
     * Group items in arrays large $size.
     * (equivalent of php array_chunk())
     *
     * @param $size
     * @return \Pipes\Pipe
     */

    public function chunk($size)
    {
        return $this->chainWith(new \Pipes\Iterator\ChunkIterator($this->getIterator(), $size));
    }
}
