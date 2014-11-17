<?php

namespace Pipes\Filter;

trait ValuesTrait
{
    /**
     * Discards the keys, returns an indexed array.
     *
     * Use this to avoid key collisions.
     *
     * @return \Pipes\Pipe
     */
    public function values()
    {
        return $this->chainWith(new \Pipes\Iterator\ValuesIterator($this->getIterator()));
    }
}