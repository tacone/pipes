<?php

use Pipes\Pipe;

/**
 * 
 * @param mixed $var
 * @return Pipe
 */
function p($var)
{
    return new Pipe($var);
}
