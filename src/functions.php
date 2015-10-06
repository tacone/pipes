<?php

use Pipes\Pipe;

/**
 * @param mixed $var
 *
 * @return Pipe
 */
function p($var = null)
{
    if (!func_num_args()) {
        return new Pipe();
    }

    return new Pipe($var);
}
