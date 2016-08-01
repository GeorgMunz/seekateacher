<?php

function model($model, $new = false) {
  $class = ucfirst($model) . '_m';
  return $class::get_instance($class, $new);
}
