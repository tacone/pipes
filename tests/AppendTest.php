<?php

namespace Pipes\Test;

class AppendTest extends BaseTestCase
{
    public function testAppend()
    {
        $array = $this->associative();
        $obj = $this->p($array)->append($this->numerics());
        $expected = $this->associative() + $this->numerics();
        $this->assertSame($expected, $obj->toArray());
    }

//    public function testAppendedToTheRoot()
//    {
//        $array = $this->associative();
//        $obj = p($array);
//
//        $obj->toIterator()->append($this->numerics());
//        $expected = $this->associative() + $this->numerics();
//        $this->assertSame($expected, $obj->toArray());
//    }
}
