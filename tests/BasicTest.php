<?php

class BasicsTest extends  \PHPUnit_Framework_TestCase
{
    
    public function testWrapper ()
    {
        $array= [1,2,3,5];
        $this->assertEquals( p($array)->toArray(), $array);
        
        list ($a, $b, $c, $d) = p($array)->toArray();
        $this->assertEquals( $b, 2);
        
        $result = [];
        foreach (p($array)->toArray() as $value)
        {
            $result[] = $value;
        }
        $this->assertEquals($array, $result);
        
        $this->assertEquals(p($array)->toArray(), $result);
        
    }
    public function testForeach ()
    {
        $array = ["bananas","01",1,2,3,4];
        $obj = p($array);
        foreach ($obj as $v)
        {
            $this->assertSame(array_shift($array), $v);
        }
    }
}
