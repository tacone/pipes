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
        $result = $obj->toArray();
        $this->assertEquals($array, $result);

        $array = $this->associative();
        $obj = p($array)->map(function ($value) {
            return strtoupper($value);
        });
        $result = $obj->toArray();
        $expected = array_map('strtoupper', $array);        
        $this->assertEquals($expected, $result);

        // same as previous, but using emit()
        $array = $this->associative();
        $obj = p($array)->map(function ($value) {
            return p()->emit(strtoupper($value));
        });
        $result = $obj->toArray();
        $expected = array_map('strtoupper', $array);        
        $this->assertEquals($expected, $result);

        // same as previous, emitting the key
        $array = $this->associative();
        $obj = p($array)->map(function ($value, $key) {
            return p()->emit(strtoupper($key), strtoupper($value));
        });
        $result = $obj->toArray();
        $expected = array_combine(array_map('strtoupper', array_keys($array)), array_map('strtoupper', $array));
        $this->assertEquals($expected, $result);
    }
}
