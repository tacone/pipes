<?php

namespace Pipes\Filter;

trait EachTrait
{
    public function each(callable $______callback)
    {
        return new static( new \CallbackFilterIterator($this->getIterator(), function() use($______callback) {
        	call_user_func_array($______callback, func_get_args());
        	return true;
        }));
    }
}