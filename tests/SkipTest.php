<?php

namespace Pipes\Test;

class SkipTest extends BaseTestCase
{

    public function testSkip()
    {
        $array = $this->associative();
        $obj = p($array)->skip(0);
        $expected = [
            'a' => 'apples',
            'b' => 'bananas',
            'c' => 'cherries',
            'd' => 'damsons',
            'e' => 'elderberries',
            'f' => 'figs',
        ];
        $this->assertSame($expected, $obj->toArray());

        $array = $this->associative();
        $obj = p($array)->skip(2);
        $expected = [
            'c' => 'cherries',
            'd' => 'damsons',
            'e' => 'elderberries',
            'f' => 'figs',
        ];
        $this->assertSame($expected, $obj->toArray());
        // and repeat
        $this->assertSame($expected, $obj->toArray());

        $array = $this->associative();
        $obj = p($array)->skip(1229);
        $expected = [];
        $this->assertSame($expected, $obj->toArray());
//
//
//
//        $obj = p($array)->limit(1, 2);
//        $expected = ['b' => 'bananas', 'c' => 'cherries'];
//        $this->assertEquals($expected, $obj->toArray());
//
//        $obj = p($array)->limit(1, 0);
//        $this->assertEquals([], $obj->toArray());
//
//        try {
//            $obj = p($array)->limit(-2);
//            $this->fail("\\OutOfRangeException expected");
//        } catch (\OutOfRangeException $ex) {
//
//        }
    }

}
