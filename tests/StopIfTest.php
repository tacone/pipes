<?php

namespace Pipes\Test;

class StopIfTest extends BaseTestCase
{
    public function testStopIf()
    {
        $array = $this->associative();

        $obj = p($array)->stopIf(function ($value, $key) {
            return $key == 'd';
        }, true);

        $expected = ['a' => 'apples', 'b' => 'bananas', 'c' => 'cherries'];
        $this->assertSame($expected, $obj->toArray());

        $obj = p($array)->stopIf(function ($value) {
            return $value == 'damsons';
        });

        $expected = ['a' => 'apples', 'b' => 'bananas', 'c' => 'cherries'];
        $this->assertSame($expected, $obj->toArray());
    }

    public function testContinueIf()
    {
        $array = $this->associative();

        $obj = p($array)->continueIf(function ($value, $key) {
            return $key != 'd';
        }, true);

        $expected = ['a' => 'apples', 'b' => 'bananas', 'c' => 'cherries'];
        $this->assertSame($expected, $obj->toArray());

        $obj = p($array)->continueIf(function ($value) {
            return $value != 'damsons';
        });

        $expected = ['a' => 'apples', 'b' => 'bananas', 'c' => 'cherries'];
        $this->assertSame($expected, $obj->toArray());
    }
}
