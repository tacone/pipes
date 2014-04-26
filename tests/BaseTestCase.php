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

    public function testMe()
    {
        //todo: strip this method without having phpunit fail all over
    }
}
