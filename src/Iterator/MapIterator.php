<?php

namespace Pipes\Iterator;

class MapIterator implements \OuterIterator {

  protected $innerIterator = NULL;
  protected $callback = NULL;

  public function __construct(\Iterator $innerIterator, $callback) {
    $this->innerIterator = $innerIterator;
    $this->callback = $callback;
  }

  protected function map($value, $key) {
    return call_user_func($this->callback, $value, $key, $this);
  }

  public function getInnerIterator() {
    return $this->innerIterator;
  }

  public function rewind() {
    $this->getInnerIterator()->rewind();
  }

  public function next() {
    $this->getInnerIterator()->next();
  }

  public function key() {
    return $this->getInnerIterator()->key();
  }

  public function current() {
    return $this->map(
      $this->getInnerIterator()->current(),
      $this->getInnerIterator()->key()
    );
  }

  public function valid() {
    return $this->getInnerIterator()->valid();
  }
}