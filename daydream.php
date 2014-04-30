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
 * distributing the effort
 */
p($this->getUsers())->shard(3, function($v, $k, Pipe $p){
    echo "shard n. {$p->getShard()}: $k => $v \n";
});

