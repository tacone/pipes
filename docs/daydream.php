<?php


/**
 * just a few ideas/case uses
 */

p($this->getUsers())->limit(1000)->map(function($user) {
    // process the user
    return p::emit($user['id'], $user);
})->each(function($userData){
    // save the data
});

// alternative (PHP 5.5) syntax
p($this)->map(function($value, &$key){
    $key = 4545;
});

// alternative (PHP 5.5) syntax
p($this)->map(function($value, $key){
    yield $key => $value;
});


/**
 * process max 100 users at once, 1000 times
 */

p($this->getUsers())->chunk(100)->limit(1000)->each(function($usersChunk) {
    foreach ( $usersChunk as $user )
    {
        print "$user->id \n";
    }
});

/**
 * Push and next
 */

$p()->push($user)->next(); // $user

/*
 * auto-next
 */

$p($array)->each('myfunc')->autonext(); // loops to the end
$p->push($item); // each will be executed

$a = new ReflectionFunction('');
$a->get

/**
 * distributing the effort
 */
p($this->getUsers())->shard(3, function($v, $k, Pipe $p){
    echo "shard n. {$p->getShard()}: $k => $v \n";
});

// in memory sqlite?
p($files)->where('size > 1000 AND mtime < NOW()-1000 ORDER BY extension, filename');
