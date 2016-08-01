<?php

function post($field = '', $val = '') {
  return _process_input($_POST, func_get_args());
}

function get($field = '', $val = '') {
  return _process_input($_GET, func_get_args());
}

function files($field = '', $val = '') {
  return _process_input($_FILES, func_get_args());
}

function _process_input(&$type, $args) {
  if ( ! isset($args[0])) {
    return $type;
  }
  else if (isset($args[1])) {
    $type[$args[0]] = $args[1];
  }
  else {
    return isset($type[$args[0]]) ? $type[$args[0]] : false;
  }
}
