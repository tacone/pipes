<?php

namespace Pipes\Test;

class SleepTest extends BaseTestCase
{

    public function testSleep()
    {
        foreach ([0.005, 0.01, 0.015] as $delay) {
            $array = array_slice($this->associative(), 0, 1);
            $obj = p($array)->sleep($delay);
            $start = microtime(true);
            $array2 = $obj->toArray();
            $end = microtime(true);
            $this->assertEquals($delay, $end - $start, "", 0.001);
            $this->assertEquals($array, $array2);
        }
    }

}
