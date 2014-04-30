<?php

namespace Pipes\Test;

class MapTest extends BaseTestCase
{

    public function testMap()
    {
        $array = $this->numerics();
        $obj = p($array)->map(function ($value) {
            return $value;
            
        });
        $expected = $obj->toArray();
        $this->assertEquals($expected, $array);

        $array = $this->associative();
        $obj = p($array)->map(function ($value) {
            return $value;
            
        });
        $expected = $obj->toArray();        
        $this->assertEquals($expected, $array);
    }

}
