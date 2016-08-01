<?php

function auth($method, $field = '') {
  $args = func_get_args();
  array_shift($args);
  return call_user_func_array(['App\Auth', $method], $args);
}
