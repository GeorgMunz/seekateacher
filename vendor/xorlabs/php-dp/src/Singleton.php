<?php

namespace XORLabs\PHP\DP;

trait Singleton
{
    /**
     * stores the instantiate instance
     *
     * @var object
     */
    protected static $instance;

    /**
     * instantiate if not and store in $instance
     *
     * @return object
     */
    public static function get_instance()
    {
        if (!static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}
