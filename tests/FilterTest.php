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

    public function testArguments()
    {
        $me = $this;
        $obj = p(['a'=>3])->filter(function($v, $k, $pipe) use($me) {
            $me->assertSame(3, $v);
            $me->assertSame('a', $k);
            $me->assertInstanceOf('\Iterator', $pipe);
            $me->assertInstanceOf('\Pipes\PipeIterator', $pipe);
        })->toArray();
    }
    public function testAppend()
    {
        $me = $this;
        $array = $obj = p(['a'=>3])->filter(function($v, $k, $pipe) use($me) {
            if ($v === 3)
            {
                $pipe->append(['b'=>4]);
            }
            return true;
        })->toArray();
        $this->assertSame(['a'=>3,'b'=>4], $array);
    }
}
