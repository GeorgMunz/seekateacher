<?php

namespace XORLabs\PHP\DP;

trait Singletons
{
    /**
     * Stores all types of instances with index
     *
     * @var array
     */
    protected static $instances = [];

    /**
     * Instantiate if not already instantiate and put in particular index
     *
     * @param  string $type
     * @param  bool $new
     * @return object
     */
    public static function getInstance($type, $isNew = false)
    {
        if ($isNew) {
            return new static();
        }

        if (!isset(static::$instances[$type])) {
            static::$instances[$type] = new static();
        }

        return static::$instances[$type];
    }
}
