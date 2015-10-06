<?php

namespace Pipes\Test\TestCase;

use Pipes\Test\BaseTestCase;

abstract class BaseIteratorTestCase extends BaseTestCase
{
    protected $expected = [
        ['a', 'apples'],
        ['b', 'bananas'],
    ];

    abstract protected function getObject();

    public function testImplementsIterator()
    {
        $obj = $this->getObject();
        $this->assertInstanceOf('\Iterator', $obj);
    }

    public function assertIteration($iterator, $expected)
    {
        $this->assertInstanceOf('\IteratorIterator', $iterator);

        $iterator->rewind();
        $this->assertTrue($iterator->valid());
        $this->assertSame($expected[0][0], $iterator->key());
        $this->assertSame($expected[0][1], $iterator->current());

        $iterator->next();
        $this->assertTrue($iterator->valid());
        $this->assertSame($expected[1][0], $iterator->key());
        $this->assertSame($expected[1][1], $iterator->current());

        foreach (range(1, 10) as $u) {
            $iterator->next();
        }
        $this->assertFalse($iterator->valid());
    }

    public function testIteration()
    {
        $this->assertIteration($this->getObject(), $this->expected);
    }
}
