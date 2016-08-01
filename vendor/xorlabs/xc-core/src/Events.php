<?php

namespace XORLabs\XC\Core;

trait Events
{
    use \XORLabs\XC\Core\Callback;

  // Contain events callbacks
  // [
  //   'after_get'=>['increment_views', function(){}, [$obj, $func]]
  // ]
  protected $__events_callbacks_always = [];

  // called only once removed from the array
  protected $__events_callbacks_once = [];

  /**
   * __once functionality.
   */
  public function __call($name, $args)
  {
      // on fly create callback array setter
    // callback functions set using this will be used
    // only once
    if (in_array($name, static::__EVENTS)) {
        // $name: event name
      // $args: callbacks
      // callback could be string, func, [$obj,$func]
      // pushing functions to callback array
      if (!isset($this->__events_callbacks_once[$name])) {
          $this->__events_callbacks_once[$name] = [];
      }

        $this->__events_callbacks_once[$name] = array_unique(
        array_merge($this->__events_callbacks_once[$name], $args)
      );

        return $this; // helps chaining
    } else {
        $trace = debug_backtrace();
        trigger_error(
          'Undefined property via __get(): '.$name.
          ' in '.$trace[0]['file'].
          ' on line '.$trace[0]['line'],
          E_USER_NOTICE);

        return;
    }
  }

  /**
   * Trigger an event and call its observers.
   * return_args if set [used in Model class].
   */
  public function __event_trigger($event, $args = [], $remove = true)
  {
      // return from callback
      $return = null;
      if (isset($this->__events_callbacks_always[$event])) {
          foreach ($this->__events_callbacks_always[$event] as $callback) {
              $return = $this->__callback_call($callback, $args);
          }
      }

      if (isset($this->__events_callbacks_once[$event])) {
          foreach ($this->__events_callbacks_once[$event] as $key => $callback) {
              $return = $this->__callback_call($callback, $args);
              // removing after call
              if ($remove) {
                  unset($this->__events_callbacks_once[$event][$key]);
              }
          }
      }

      return $return;
  }
}
