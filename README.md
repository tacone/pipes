Pipes
==============
[![Build Status](https://travis-ci.org/tacone/pipes.svg)](https://travis-ci.org/tacone/pipes)
[![Coverage Status](https://img.shields.io/coveralls/tacone/pipes.svg)](https://coveralls.io/r/tacone/pipes)

Pipes is a thin wrapper around PHP SPL iterators.

With Pipes, you can write code like this:

```php
$result = p($array)->filter(function($v) {
    return $v % 2;
})
->each('var_dump')
->limit(100)
->toArray();
```

Unlike many collection libraries (such as underscore.php or
Laravel's Illuminate/Collection) each step will be executed
sequentially for each item. For instance, in the sample code
above, only the first 100 even numbers would be printed.

The advantages are:
- you can traverse enourmous arrays using less memory
- you don't execute unnecessary operations when you need just
  a subset.
- the resulting code is neat and pretty

Of course this is just the beginning.

## Features

The current featureset is pretty minimal:

```php
p($array)->append($arrayOrIterator); // uses \AppendIterator
p($array)->chunk($size); // spits chunks like array_chunk
p($array)->each($function); // executes $function for each element
p($array)->files($function); // uses \GlobIterator
p($array)->filter($function); // uses \FilterIteratorCallback
p($array)->limit($skip = 0, $max); // uses \LimitIterator
p($array)->map($function); // sort of array_map. Take a look to the tests.
p($array)->skip($num); // skips the first $num elements
```