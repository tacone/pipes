<?php

namespace Pipes\Test;

class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    public static $useToIterator = false;

    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        error_reporting(-1);
        parent::__construct($name, $data, $dataName);
    }

    /**
     * @return \Pipes\Pipe|\Pipes\PipeIterator
     */
    public function p()
    {
        $arguments = func_get_args();
        $pipe = call_user_func_array('\p', $arguments);

        return static::$useToIterator ? $pipe->toIterator() : $pipe;
    }

    public function run(\PHPUnit_Framework_TestResult $result = null)
    {
        if ($result === null) {
            $result = $this->createResult();
        }
        // test every request-format
        $first = 0;
        foreach ([false, true] as $useToIterator) {
            static::$useToIterator = $useToIterator;
            if (!$first) {
                $this->setUp();
            }
            $result->run($this);
            if ($first) {
                $this->tearDown();
            }
        }

        return $result;
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
            'array' => ['a', 'b', 'c'],
            'float' => 1.7,
            'object' => new \stdclass(),
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
        foreach ($iterator as $key => $value) {
            $result[$key] = $value;
        }

        return $result;
    }
}
