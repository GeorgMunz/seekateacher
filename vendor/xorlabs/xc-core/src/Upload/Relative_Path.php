<?php

namespace XORLabs\XC\Core\Upload;

class Relative_Path
{
    use \XORLabs\XC\Core\Callback;

    public static function ym($file)
    {
        return   date('Y').'/'.date('m');
    }

    public static function exec($method, $file)
    {
        return static::__callback_call_static($method, [$file]);
    }
}
