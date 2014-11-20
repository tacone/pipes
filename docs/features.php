<?php

/**
 * A brief list of features we want in
 */

// iterator interface
p()->next();
p()->current();
p()->valid();
p()->rewind();
p()->getInnerIterator();

// pipes
p()->chunk($num); // ok
p()->each($function); //ok
p()->filter($function); //ok
p()->limit($skip = 0, $max); //ok
p()->map($function); //okdi

// factory methods
p()->emit($key = null, $value); //ok
p()->flags($flag1, $flag2 =null, $flagN = null);

// terminals
p()->toValues(); // ok. outputs an indexed array.
p()->toArray(); // ok. outputs an array. Keys preserved (last key wins)
p()->toIterator(); // ok. outputs an array. Keys preserved (last key wins)
p()->reduce($function = null); // outputs an array. Keys preserved. Conflicts handled by $function


// timed pipes
p()->maxTime($seconds); //also floats 0.001 etc
p()->wait($seconds, $function = null); // !$function ? wait again

// push to other queues (array, queues, chains)
p()->filter($function, $queue);
p()->map($function, $queue);

// accumulators
p()->groupBy($function);
p()->sort();

// queues
p()->queues->sqlite('queue.db');
p()->queues->file('queue.txt');
p()->queues->json('queue.json'); // one json per line
p()->queues->post($url, $moreParams);

// --- advanced stuff

// caching
p()->keep(3)->each(function(){
    $previous = p()->kept(-1); // also -2, -3
});

// map reduce
p()->shard($function);
p()->reduce($shard);