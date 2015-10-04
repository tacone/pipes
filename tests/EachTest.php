<?php

namespace Pipes\Test;

class EachTest extends BaseTestCase
{

    public function testEach()
    {
        $array = $this->associative();
        $counter = 0;
        $obj = p($array)->each(function () use (&$counter) {
            $counter++;
        }, true);
        $obj->toArray();
        $this->assertEquals(6, $counter);

        $array = $this->associative();
        $result = [];
        $obj = p($array)->each(function ($value, $key) use (&$result) {
            $result[$key] = $value;
        }, true);
        $obj->toArray();
        $this->assertEquals($array, $result);
    }

}
