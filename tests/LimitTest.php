<?php

namespace Pipes\Test;

class LimitTest extends BaseTestCase
{

    public function testLimit()
    {
        $array = $this->associative();
        $obj = p($array)->limit(3);
        $expected = ['a' => 'apples', 'b' => 'bananas', 'c' => 'cherries'];
        $this->assertEquals($expected, $obj->toArray());
        
        $obj = p($array)->limit(1,2);
        $expected = [ 'b' => 'bananas', 'c' => 'cherries'];
        $this->assertEquals($expected, $obj->toArray());
        
        try {
            $obj = p($array)->limit(-2);
            $this->fail("\\OutOfRangeException expected");
        } catch (\OutOfRangeException $ex) {
            
        }
        
    }

}
