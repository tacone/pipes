<?php

namespace Pipes\Iterator;

use Traversable;

class SkipIterator extends \FilterIterator
{
    /**
     * @var integer number of elements to skip
     */
    protected $num;
    protected $skipped = 0;

    public function __construct(Traversable $iterator, $num)
    {
        parent::__construct($iterator);
        $this->num = $num;
    }

    /**
     * Check whether the current element of the iterator is acceptable
     * @link http://php.net/manual/en/filteriterator.accept.php
     * @return bool true if the current element is acceptable, otherwise false.
     */
    public function accept()
    {
        if ($this->skipped >= $this->num) {
            return true;
        }

        $this->skipped++;
        return false;
    }

    public function rewind()
    {
        $skipped = $this->skipped;
        try {
            // order matters
            $this->skipped = 0;
            parent::rewind();
        } catch (\Exception $e) {
            $this->skipped = $skipped;
            throw $e;
        }

    }


}