<?php

function dump($var) {
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
}

function rutime($ru, $rus, $index) {
    return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
     -  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
}

function exe_start() {
  $GLOBALS['rustart'] = getrusage();
}

function exe_end() {
  $ru = getrusage();
  echo "This process used " . rutime($ru, $GLOBALS['rustart'], "utime") .
      " ms for its computations\n";
  echo "It spent " . rutime($ru, $GLOBALS['rustart'], "stime") .
      " ms in system calls\n";
}

function array_randi($arr) {
  return $arr[array_rand($arr)];
}

function array_randis($arr, $num = 10) {
  $keys = array_rand($arr, $num);
  $ret = [];
  foreach ($keys as $key) {
    $ret[] = $arr[$key];
  }
  return $ret;
}
