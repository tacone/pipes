<?php

namespace Pipes\Test;

class SleepTest extends BaseTestCase
{
    public function testSleep()
    {
        foreach ([0.01, 0.02, 0.03] as $delay) {
            $array = array_slice($this->associative(), 0, 1);
            $obj = p($array)->sleep($delay);
            $start = microtime(true);
            $array2 = $obj->toArray();
            $end = microtime(true);
            $this->assertEquals($delay, $end - $start, '', 0.05);
            $this->assertEquals($array, $array2);
        }
    }
}
