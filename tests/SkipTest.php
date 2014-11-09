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
        $obj = p($array)->skip(1000);
        $expected = [];
        $this->assertSame($expected, $obj->toArray());
    }

}
