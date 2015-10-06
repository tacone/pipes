<?php

namespace Pipes\Test;

class ValueTest extends BaseTestCase
{
    public function testValue()
    {
        foreach ($this->types() as $var) {
            $value = new \Pipes\Concept\Value($var);
            $this->assertSame($value->getValue(), $var);
        }
    }
}
