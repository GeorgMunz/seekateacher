<?php
namespace XORLabs\XC\Helpers;

class File {

  public static function file_exists($fileName, $caseSensitive = false) {
    if(file_exists($fileName)) {
      return $fileName;
    }
    if($caseSensitive) return false;

    // Handle case insensitive requests
    $directoryName = dirname($fileName);
    $fileArray = glob($directoryName . '/*', GLOB_NOSORT);
    $fileNameLowerCase = strtolower($fileName);
    foreach($fileArray as $file) {
      if(strtolower($file) == $fileNameLowerCase) {
        return $file;
      }
    }
    return false;
  }

  public static function ext($str) {
    $re = "/\\.*([^.]*)$/";
    preg_match($re, $str, $matches);
    return (count($matches) == 2) ? $matches[1] : false;
  }

  public static function name($str) {
    $re = "/\\.*([^.]*)$/";
    return preg_replace($re, '', $str);
  }

  public static function name_insert($str, $ins) {
    return self::name($str) . $ins . '.' . self::ext($str);
  }

}
