<?php
//
//namespace Pipes\Iterator;
//
//class MapIterator extends \FilterIterator
//{
//    protected $callback = null;
//    protected $result = null;
//
//    public function __construct(\Iterator $innerIterator, $callback)
//    {
//        parent::__construct($innerIterator);
//        $this->callback = $callback;
//    }
//
//    protected function map($value, $key)
//    {
//        $this->result = call_user_func($this->callback, $value, $key, $this);
//    }
//
//    public function key()
//    {
//        if (!is_a($this->result, '\\Pipes\\Concept\\Emittable') || !$this->result->hasKey()) {
//            return $this->getInnerIterator()->key();
//        }
//
//        return $this->result->getKey();
//    }
//
//    public function current()
//    {
//        if (!is_a($this->result, '\\Pipes\\Concept\\Emittable')) {
//            return $this->result;
//        }
//
//        return $this->result->getValue();
//    }
//
//    public function accept()
//    {
//        return true;
//    }
//
//    public function valid()
//    {
//        if (!$valid = $this->getInnerIterator()->valid()) {
//            return false;
//        }
//        $this->map(
//            $this->getInnerIterator()->current(),
//            $this->getInnerIterator()->key()
//        );
//
//        return true;
//    }
//}

