<?php

namespace Pipes\Test;

class ChunkTest extends BaseTestCase
{

    public function testChunk()
    {
        $array = $this->associative();
        $obj = p($array)->chunk(3);
        $expected = [
            ['apples', 'bananas', 'cherries']
            ,
            ['damsons', 'elderberries', 'figs']
        ];
        $this->assertSame($expected, $obj->toArray());
    }

}
