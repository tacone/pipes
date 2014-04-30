<?php

namespace Pipes\Concept;

trait EmitTrait
{
    public function emit($key, $value = null)
    {
    	
    	if ( func_num_args() == 1)
    	{
    		$emit = new Emittable($key);
    	} elseif (func_num_args() >= 2) {
    		$emit = new Emittable($value);
    		$emit->setKey($key);
    	}
        return $emit;
    }
}	