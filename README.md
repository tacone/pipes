Pipes
==============
[![Build Status](https://travis-ci.org/tacone/pipes.svg)](https://travis-ci.org/tacone/pipes)
[![Coverage Status](https://img.shields.io/coveralls/tacone/pipes.svg)](https://coveralls.io/r/tacone/pipes)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/tacone/pipes/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/tacone/pipes/?branch=master)

Pipes is a thin wrapper around PHP SPL iterators and generators.

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
above, only the first 101 even numbers would be printed
(the 101th will reach each() but not be passed through limit())

The advantages are:
- you can traverse enourmous arrays using less memory
- you don't execute unnecessary operations when you need just
  a subset.
- you can control the flow
- the resulting code is neat and pretty

Of course this is just the beginning.


## Features

The current feature set is pretty minimal. Below is a syntetic description
of the current methods. Keep in mind they are all documented and available
for your favorite IDE auto-completion.

```php
// filters
p($array)->chunk($size); // spits chunks like array_chunk
p($array)->each($function); // executes $function for each element
p($array)->filter($function); // uses \FilterIteratorCallback
p()->values(); // returns all the elements, reindexing the keys

// flow control
p($array)->limit($skip = 0, $max); // uses \LimitIterator
p($array)->skip($num); // skips the first $num elements
p($array)->continueIf($callback); // continues as long as callback gives true
p($array)->stopIf($callback); // stops if the callback is true
p($array)->sleep($seconds); // sleeps for $seconds seconds at each iteration

// transformators
p($array)->map($function); // sort of array_map. Take a look to the tests.

// iterator factories
p()->files($globPattern); // uses \GlobIterator, accepts the same args

// terminators
p()->toArray(); // returns a key=>value array. Last key wins.
p()->toValues(); // returns an indexed array. No key collision.

// variants
p()->toIterator(); // returns a full IteratorIterator/OuterIterator Pipe
p()->toTraversable(); // returns an IteratorAggregate Pipe (much faster)
```

## Example:

Here is a quasi real world example: a simple scraper that handles retries,
failures, etc.

```php
$website = new Website();

$initialState = new stdClass();
$initialState->categoryId = 1;
$initialState->postId = 1;
$initialState->tries = 1;
$initialState->failures = 0;

$context = clone $initialState;

$pipe = p([$context])
    // transform the single item array into an infinite stream of
    // items consisting of the same context instance
    ->infinite()
    // make sure not to loop more than 100 times, we don't need
    // too much data
    ->limit(100)
    // call some method to download the HTML of the page
    ->map([$website, 'downloadPage'])
    // pass the HTML to some method to turn it into a database record
    ->map([$website, 'pageToRecord'])
    // perform some custom check or transformation if you wish
    ->map(function ($record) use ($website, $context) {
        return $record;
    })
    // dump every record to the screen or to your custom logger
    ->each(function () use ($context) {
        var_dump($context);
    })
    // here is a sample logic for handling retries, failures and enumeration
    // the beauty here is you keep all the state into a single external object
    // that you can easily serialize and save somewhere.
    ->each(function ($record) use ($context, $initialState) {
        if ($record['page_found']) {
            $context->postId++;
            $context->tries = $initialState->tries;
            $context->failures = $initialState->failures;
            return;
        }

        if ($context->tries < 3) {
            $context->tries++;
            return;
        }

        $context->postId++;
        $context->failures++;
        $context->tries = $initialState->tries;

        if ($context->failures >= 3) {
            $context->categoryId++;
            $context->postId = 1;
            $context->failures = $initialState->failures;
            $context->tries = $initialState->tries;
        }
    })
    // don't save the errors in the database
    ->filter(function ($record) {
        return !empty($record['page_found']);
    })
    // save the record in the database
    ->each(function ($record) {
        // .. up to you!
    })
    // sleep for 1.5 seconds to avoid bringing down the website
    ->sleep(1.5);

// Everything ok, isn't it? Notice than nothing happened yet.
// $pipe is now an aggregate iterator, which does not do anything
// until you cycle on it or you call toArray();

foreach ($pipe as $record) {
    // you can leave this empty or insert your custom logic here
}

// if you don't need logic, you may just run it with
$results = $pipe->toArray();

// and if you do it again, it will run again :)
$results = $pipe->toArray();
```
