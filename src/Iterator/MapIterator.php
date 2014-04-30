<?php

namespace Pipes\Iterator;

class MapIterator implements \OuterIterator {

  protected $innerIterator = null;
  protected $callback = null;
  protected $result = null;

  public function __construct(\Iterator $innerIterator, $callback) {
    $this->innerIterator = $innerIterator;
    $this->callback = $callback;
  }

  protected function map($value, $key) {
    if (!$this->result)
    {
      $this->result = new \Pipes\Concept\Value( call_user_func($this->callback, $value, $key, $this) );
    }
    return $this->result->getValue();
  }

  public function getInnerIterator() {
    return $this->innerIterator;
  }

  public function rewind() {
    $this->result = null;
    $this->getInnerIterator()->rewind();
  }

  public function next() {
    $this->result = null;
    $this->getInnerIterator()->next();
  }

  public function key() {
    $result = $this->map(
      $this->getInnerIterator()->current(),
      $this->getInnerIterator()->key()
    );
    if (!is_a($result, "\Pipes\Concept\Emittable") || !$result->hasKey()) return $this->getInnerIterator()->key();
    return $result->getKey();
  }

  public function current() {
    $result = $this->map(
      $this->getInnerIterator()->current(),
      $this->getInnerIterator()->key()
    );
    if (!is_a($result, "\Pipes\Concept\Emittable")) return $result;
    return $result->getValue();
  }

  public function valid() {
    $valid = $this->getInnerIterator()->valid();
    if ( !$valid ) $this->result = null;
    return $valid;
  }
}