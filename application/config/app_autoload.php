<?php

spl_autoload_register(function ($class) {
  // CI
  if (strpos($class, 'CI_') === 0) {
      app_require_from_paths([
      BASEPATH.'libraries',
            BASEPATH.'core',
        ], str_replace('CI_', '', $class));
  }
  // Models
  elseif (preg_match('/_m$/', $class)) {
      app_require_from_paths([
      APPPATH.'models',
        ], $class);
  }
});

function app_require_from_paths($paths, $file_name)
{
    $file_name = str_replace('\\', '/', $file_name);
    foreach ($paths as $path) {
        $file = $path.'/'.$file_name.'.php';
        if (file_exists($file)) {
            require_once $file;

            return true;
        }
    // one step inside
    $file = $path.'/'.$file_name.'/'.$file_name.'.php';
        if (file_exists($file)) {
            require_once $file;

            return true;
        }
    }

    return false;
}
