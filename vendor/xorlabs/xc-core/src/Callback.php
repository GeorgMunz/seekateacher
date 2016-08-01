<?php

namespace XORLabs\XC\Core;

trait Callback
{
    /**
     * smartly call the callback.
     */
    public function __callback_call($callback, $args)
    {
        // Check for callback args
        if (is_string($callback) && strpos($callback, '(')) {
            preg_match('/([a-zA-Z0-9\_\-]+)(\(([a-zA-Z0-9\_\-\., ]+)\))?/', $callback, $matches);
            $callback = $matches[1];
            $callback_args = explode(',', $matches[3]);
            $args = array_merge($args, $callback_args);
        }

        $return = null;
        // self method call
        if (is_string($callback) && method_exists($this, $callback)) {
            $return = call_user_func_array([$this, $callback], $args);
        }
        // object method call
        elseif (is_array($callback) && (count($callback) == 2)) {
            // instantiate
            if (is_string($callback[0])) {
                $regx = '/_m$/';
                if (preg_match($regx, $callback[0])) {
                    // it's a model
                    $model = preg_replace($regx, '', $callback[0]);
                    $callback[0] = model($model);
                } else {
                    $callback[0] = new $callback[0]();
                }
            }
            $return = call_user_func_array($callback, $args);
        }
        // object method call with passed args at attach event
        elseif (is_array($callback) && (count($callback) > 2)) {
            // instantiate
            if (is_string($callback[0])) {
                $regx = '/_m$/';
                if (preg_match($regx, $callback[0])) {
                    // it's a model
                    $model = preg_replace($regx, '', $callback[0]);
                    $callback[0] = model($model);
                } else {
                    $callback[0] = new $callback[0]();
                }
            }
            $attach_args = array_splice($callback, 2);
            $args = array_merge($args, $attach_args);
            $return = call_user_func_array($callback, $args);
        }
        // direct function call
        elseif (is_callable($callback)) {
            $return = call_user_func_array($callback, $args);
        }
        // error
        else {
            die('Callback NOT called');
        }

        return $return;
    }

    /**
     * smartly call the callback.
     */
    public static function __callback_call_static($callback, $args)
    {
        $return = null;
        // self method call
        if (is_string($callback) && method_exists(get_called_class(), $callback)) {
            $return = call_user_func_array([get_called_class(), $callback], $args);
        }
        // object method call
        elseif (is_array($callback) && (count($callback) == 2)) {
            $return = call_user_func_array($callback, $args);
        }
        // direct function call
        elseif (is_callable($callback)) {
            $return = call_user_func_array($callback, $args);
        }
        // error
        else {
            die('Callback NOT called');
        }

        return $return;
    }
}
