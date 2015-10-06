<?php

namespace Pipes\Filter;

trait StopIfTrait
{
    /**
     * Stops the iteration if the callback returns a true-ish value.
     * The current element will not be included
     *
     * The passed callback will be invoked with the following argument:
     *
     *      - $value (iterator's current())
     *
     * If the second parameter is true the following arguments will be added
     * to the call:
     *
     *      - $key (iterator's key())
     *      - $iterator (the iterator itself)
     *
     * @param $______callback
     * @param bool $______allArgs
     * @return \Pipes\Pipe
     */
    public function stopif($______callback, $______allArgs = false)
    {
        $iterator = $this->getIterator();
        $pipe = $this;

        $generator = function () use ($pipe, $iterator, $______callback, $______allArgs) {
            foreach ($iterator as $key => $value) {
                if ($pipe->executeCallback($______callback, $______allArgs, $value, $key, $iterator)
                ) {
                    return;
                }
                yield $key => $value;
            }
        };
        return $this->chainWith($generator());
    }

    /**
     * Stops the iteration if the callback returns a true-ish value.
     * The current element will not be included
     *
     * The passed callback will be invoked with the following argument:
     *
     *      - $value (iterator's current())
     *
     * If the second parameter is true the following arguments will be added
     * to the call:
     *
     *      - $key (iterator's key())
     *      - $iterator (the iterator itself)
     *
     * @param $______callback
     * @param bool $______allArgs
     * @return \Pipes\Pipe
     */
    public function continueIf($______callback, $______allArgs = false)
    {
        $iterator = $this->getIterator();
        $pipe = $this;

        $generator = function () use ($pipe, $iterator, $______callback, $______allArgs) {
            foreach ($iterator as $key => $value) {
                if (!$pipe->executeCallback($______callback, $______allArgs, $value, $key, $iterator)
                ) {
                    return;
                }
                yield $key => $value;
            }
        };
        return $this->chainWith($generator());
    }
}
