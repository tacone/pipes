<?php

namespace Pipes\Filter;

trait ValuesTrait
{
    /**
     * Returns all the elements, reindexes the keys (0,1,2,..,n).
     *
     * Use this to avoid key collisions.
     *
     * @return \Pipes\Pipe
     */
    public function values()
    {
        return $this->chainWith(new \Pipes\Iterator\ValuesIterator($this->getIterator()));
    }

    /*
     * Discards the keys, returns an indexed array.
     *
     * Shortcut for <code>p($iterator)->values->toArray();</code>
     */
    public function toValues()
    {
        return $this->values()->toArray();
    }
}
