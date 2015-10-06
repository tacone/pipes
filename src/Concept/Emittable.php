<?php

namespace Pipes\Concept;

class Emittable extends Value
{
    protected $key;

    public function getKey()
    {
        if (!$this->key) {
            throw new \LogicException('Emitted value has no key defined');
        }

        return $this->key->getValue();
    }
    public function setKey($key)
    {
        $this->key = new Value($key);
    }
    public function hasKey()
    {
        return is_object($this->key);
    }
}
