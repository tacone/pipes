<?php

namespace Pipes\Test\TestCase;

use Pipes\Test\BaseTestCase;

abstract class BaseIteratorTestCase extends BaseTestCase
{
    protected $expected = [
        ['a', 'apples'],
        ['b', 'bananas']
    ];

    abstract protected function getObject();

    public function testImplementsIterator()
    {
        $obj = $this->getObject();
        $this->assertInstanceOf('\Iterator', $obj);
    }

    public function testIteration()
    {
        $e = $this->expected;

        $obj = $this->getObject();
        $this->assertInstanceOf('\IteratorIterator', $obj);

        $obj->rewind();
        $this->assertTrue($obj->valid());
        $this->assertSame($e[0][0], $obj->key());
        $this->assertSame($e[0][1], $obj->current());

        $obj->next();
        $this->assertTrue($obj->valid());
        $this->assertSame($e[1][0], $obj->key());
        $this->assertSame($e[1][1], $obj->current());

        foreach (range(1, 10) as $u) {
            $obj->next();
        }
        $this->assertFalse($obj->valid());
    }
}
