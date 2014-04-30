<?php
namespace Pipes\Test;

class BaseTestCase extends \PHPUnit_Framework_TestCase
{

    protected function numerics()
    {
        return [1, 2, 3, 5];
    }

    protected function associative()
    {
        return [
            'a' => 'apples',
            'b' => 'bananas',
            'c' => 'cherries',
            'd' => 'damsons',
            'e' => 'elderberries',
            'f' => 'figs',
        ];
    }

    protected function types()
    {
        return [
            'boolean' => true,
            'boolean_false' => false,
            'number' => 12,
            'string' => 'hello world',
            'array' => ['a','b','c'],
            'float' => 1.7,
            'object' => new \stdclass,
            'null' => null,
        ];
    }

    public function testMe()
    {
        //todo: strip this method without having phpunit fail all over
    }
}
