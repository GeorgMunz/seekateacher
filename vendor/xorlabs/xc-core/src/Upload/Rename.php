<?php

namespace XORLabs\XC\Core\Upload;

class Rename
{
    use \XORLabs\XC\Core\Callback;

    public static function time($file)
    {
        return time().'.'.$file->ext;
    }

    public static function orig($file)
    {
        return $file->name;
    }

    public static function post($file)
    {
        return $_POST[$file->field.'_name'].'.'.$ext;
    }

  /**
   * exec.
   */
  public static function exec($method, $file, $callback = true)
  {
      return ($callback) ? static::__callback_call_static($method, [$file]) : $method;
  }
}
