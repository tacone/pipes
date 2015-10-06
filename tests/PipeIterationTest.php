<?php

namespace Pipes\Test;

use Pipes\Test\TestCase\BaseIteratorTestCase;

class PipeIterationTest extends BaseIteratorTestCase
{
    public function testImplementsIteratorAggregate()
    {
        $obj = p($this->associative());
        $this->assertInstanceOf('\IteratorAggregate', $obj);
    }

    protected function getObject()
    {
        return p(p($this->associative()))->toIterator();
    }
}
