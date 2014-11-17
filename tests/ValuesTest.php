<?php

namespace Pipes\Test;

class ValuesTest extends BaseTestCase
{

    public function testValues()
    {
        $array = $this->associative();
        $obj = p($array)->values();
        $expected = [
            'apples',
            'bananas',
            'cherries',
            'damsons',
            'elderberries',
            'figs',
        ];
        $this->assertSame($expected, $obj->toArray());
    }

    public function testRewind()
    {
        $array = $this->associative();
        $obj = p($array)->values();
        $expected = [
            'apples',
            'bananas',
            'cherries',
            'damsons',
            'elderberries',
            'figs',
        ];

        $this->assertSame($expected, $this->foreachArray($obj));
        // foreach calls a rewind
        $this->assertSame($expected, $this->foreachArray($obj));
    }

}
