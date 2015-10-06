<?php

namespace Pipes\Test;

use Pipes\Test\TestCase\BaseIteratorTestCase;

class OuterIteratorTest extends BaseIteratorTestCase
{
    public function testImplementsIteratorAggregate()
    {
        $obj = p($this->associative());
        $this->assertInstanceOf('\IteratorAggregate', $obj);
    }

    protected function getObject()
    {
        return  p($this->associative())->toIterator();
    }
}
