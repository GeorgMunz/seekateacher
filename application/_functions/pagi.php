<?php

function pagi($method = '') {
  if ( ! $method) {
    return App\Pagination::get_instance();
  }
  else {
    $args = func_get_args();
    array_shift($args);
    return call_user_func_array([App\Pagination::get_instance(), $method], $args);
  }
}
