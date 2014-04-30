<?php

namespace Pipes\Concept;


class Emittable extends Value
{
	protected $key;
	
	function getKey()
	{
		if(!$this->key)
		{
			throw new \LogicException("Emitted value has no defined key");
			
		}
		return $this->key->getValue();
	}
	function setKey($key)
	{
		$this->key = new Value($key);
	}
	function hasKey()
	{
		return is_object($this->key);
	}
	
}