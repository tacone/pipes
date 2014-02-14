<?php

use pipes\Pipe;

/**
 * 
 * @param mixed $var
 * @return Pipe
 */
function p($var)
{
    return new Pipe($var);
}
