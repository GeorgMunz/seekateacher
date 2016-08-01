<?php

function fsp($method = '')
{
    if ($method) {
        $args = array_slice(func_get_args(), 1);

        return call_user_func_array([App\Fsp::get_instance(), $method], $args);
    } else {
        return App\Fsp::get_instance();
    }
}
