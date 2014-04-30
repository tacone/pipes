<?php

namespace Pipes\Test;

class EachTest extends BaseTestCase
{

    public function testEach()
    {
        $array = $this->associative();
        $counter = 0;
        $obj = p($array)->each(function () use (&$counter){
            $counter++;         
            
        });
        $obj->toArray();
        $this->assertEquals(6, $counter);
    }

}
