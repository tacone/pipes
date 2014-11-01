Pipes
==============

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

Of course this is just the beginning.