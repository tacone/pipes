<?php

namespace Pipes\Test;

use Pipes\Test\TestCase\CallbackTestCase;

class MapTest extends CallbackTestCase
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

    /**
     * In case of multiple items with the same key, the last one should win.
     */
    public function testKeyConflicts()
    {
        // test with string keys
        $array = $this->numerics();
        $obj = p($array)->map(function ($value) {
            return p()->emit('a', $value);
        });
        $result = $obj->toArray();
        $this->assertEquals([
            'a' => 5,
        ], $result);

        // test with numeric indexes
        $array = $this->numerics();
        $obj = p($array)->map(function ($value) {
            return p()->emit(0, $value);
        });
        $result = $obj->toArray();
        $this->assertEquals([
            0 => 5,
        ], $result);
    }

    public function testGenerator()
    {
        $array = function () {
            $a = 0;
            while ($a <= 1e4) {
                yield $a++;
            }
        };

        $obj = p($array())->map(function ($value) {
            return p()->emit(0, $value);
        });
        $result = $obj->toArray();
        $this->assertEquals([
            0 => 1e4,
        ], $result);
    }

//    public function testAppend()
//    {
//        $me = $this;
//        $array = $obj = p(['a' => 3])->map(function ($v, $k, $pipe) {
//            var_dump($pipe);
//            if ($v === 3) {
//                $pipe->append(['b' => 4]);
//            }
//
//            return $v;
//        })->toArray();
//        $this->assertSame(['a' => 3, 'b' => 4], $array);
//    }
}
