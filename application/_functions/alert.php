<?php

function alert($method = '') {
  if ( ! $method) {
    return App\Alert::display();
  }
  else {
    $args = func_get_args();
    array_shift($args);
    return call_user_func_array([App\Alert::get_instance(), $method], $args);
  }
}
