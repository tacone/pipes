<?php

namespace Pipes\Test;

class FilterTest extends BaseTestCase
{

    public function testFilter()
    {
        $array = $this->numerics();
        $obj = p($array)->filter(function ($v, $k) {
            return $v % 2;
        });
        $result = $obj->toArray();
        $this->assertEquals([
            0 => 1,
            2 => 3,
            3 => 5
        ], $result);

        // keys should not be preserved
        // but we do it when possible
        $array = $this->associative();
        $obj = p($array)->filter(function ($v, $k) {
            return in_array($k, ['a', 'c']);
        });
        $result = $obj->toArray();
        $this->assertEquals([
            'a' => 'apples',
            'c' => 'cherries',
        ], $result);
    }



}
