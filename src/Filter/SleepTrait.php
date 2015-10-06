<?php

namespace Pipes\Filter;

trait SleepTrait
{
    /**
     * Sleeps a given number of seconds in each iteration.
     *
     * @param float $seconds
     *
     * @return \Pipes\Pipe
     */
    public function sleep($seconds)
    {
        return $this->chainWith(
            new \CallbackFilterIterator($this->getIterator(),
                function () use ($seconds) {
                    usleep($seconds * 1000000);

                    return true;
                }));
    }
}
