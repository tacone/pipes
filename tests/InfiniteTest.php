<?php

namespace Pipes\Test;

class InfiniteTest extends BaseTestCase
{
    public function testInfinite()
    {
        $array = array_slice($this->associative(), 0, 2);
        $obj = p($array)->infinite();

        $result = [];
        $i = 0;
        foreach ($obj as $value) {
            $result[] = $value;
            ++$i;
            if ($i >= 6) {
                break;
            }
        }

        $expected = [
             'apples',  'bananas',
             'apples',  'bananas',
             'apples',  'bananas',
        ];

        $this->assertSame($expected, $result);
    }
}
