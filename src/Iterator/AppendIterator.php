<?php
/**
 * Derived by Guzzle's AppendIterator https://github.com/guzzle/iterator/blob/master/AppendIterator.php
 * credit goes to the original authors
 */

namespace Pipes\Iterator;

use Traversable;

/**
 * AppendIterator that is not affected by https://bugs.php.net/bug.php?id=49104
 */
class AppendIterator extends \AppendIterator
{
    /**
     * Works around the bug in which PHP calls rewind() and next() when appending
     *
     * @param \Iterator $iterator Iterator to append
     */
    public function append($iterator)
    {
        if (is_array($iterator))
        {
            $iterator = new \ArrayIterator($iterator);
        }
        $this->getArrayIterator()->append($iterator);
    }
}