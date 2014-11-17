<?php
namespace Pipes\Test;

class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        error_reporting(-1);
        parent::__construct($name, $data, $dataName);
    }

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

    public function foreachArray($iterator)
    {
        $result = [];
        foreach ($iterator as $key => $value)
        {
            $result[$key] = $value;
        }
        return $result;
    }
}
