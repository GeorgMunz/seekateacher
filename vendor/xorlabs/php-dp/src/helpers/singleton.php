<?php

function singleton($class, $args)
{
    $method = array_shift($args);
    if ( ! $method) {
      return $class::getInstance();
    }
    else {
      return call_user_func_array([$class::getInstance(), $method], $args);
    }
}
