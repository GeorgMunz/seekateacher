<?php
namespace XORLabs\XC\Helpers;

class Dir {

  public static function rrmdir($dir) {
    if (is_dir($dir))
    {
      $objects = scandir($dir);
      foreach ($objects as $object)
      {
        if ($object != "." && $object != "..")
        {
          if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
        }
      }
      reset($objects);
      rmdir($dir);
    }
  }


  public static function cmkdir($dir, $type = 0777, $recursive = true) {
    if ( ! is_dir($dir)) {
      mkdir($dir, $type, $recursive);
    }
  }

}
