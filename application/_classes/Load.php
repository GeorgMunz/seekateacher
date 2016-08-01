<?php
namespace App;

class Load {

  public static function config($name) {
    $config_path = APPPATH . '/config';
    if (ENVIRONMENT != 'development') {
      $config_path = $config_path . '/' . ENVIRONMENT;
    }
    $filename = $config_path . '/' . $name . '.php';
    if (file_exists($filename)) {
      include $filename;
    }
    else {
      include APPPATH . "/config/{$name}.php";
    }
    return $config;
  }

}
