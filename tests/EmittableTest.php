<?php
namespace Pipes\Test;

class EmittableTest extends BaseTestCase
{

    public function testValue()
    {
    	foreach ( $this->types() as $var )
    	{
    		$emitted = new \Pipes\Concept\Emittable($var);
    		$this->assertSame($emitted->getValue(), $var);
    		$this->assertFalse($emitted->hasKey());
    		try {
    			$emitted->getKey();
    		} catch (\LogicException $e)
    		{
    			// we expect this
    		}
    	}
    }
	public function testKeyValue()
    {
    	foreach ( $this->types() as $key => $var )
    	{
    		$emitted = new \Pipes\Concept\Emittable($var);
    		$emitted->setKey($key);
    		$this->assertSame($emitted->getValue(), $var);
    		$this->assertSame($emitted->getKey(), $key);
    		$this->assertTrue($emitted->hasKey());
    	}
    }
}