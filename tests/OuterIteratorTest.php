<?php

namespace Pipes\Test;

use Pipes\Test\Tools\TestIterator;

class IteratorFeaturesTest extends BaseTestCase
{

    public function testImplementsIteratorAggregate()
    {
        $obj = p($this->associative());
        $this->assertInstanceOf('\IteratorAggregate', $obj);
    }

    public function testToIterator()
    {
        $pipe = p($this->associative());
        $obj = $pipe->toIterator();
        $this->assertInstanceOf('\IteratorIterator', $obj);

        $obj->rewind();
        $this->assertTrue($obj->valid());
        $this->assertSame('a', $obj->key());
        $this->assertSame('apples', $obj->current());

        $obj->next();
        $this->assertTrue($obj->valid());
        $this->assertSame('b', $obj->key());
        $this->assertSame('bananas', $obj->current());

        foreach (range(1, 10) as $u) {
            $obj->next();
        }
        $this->assertFalse($obj->valid());
    }
}
