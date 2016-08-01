<?php
namespace XORLabs\XC\Core;

class Alert {
  use \XORLabs\PHP\DP\Singleton;

  // Alert Types
  const ERROR = 0;
  const SUCCESS = 1;
  const WARNING = 2;
  const INFO = 3;

  // The Session Key
  protected static $_session_key = 'xc_alerts';

  // Store alerts
  protected static $_alerts;

  public static function set_error($msg, $idx = '') {
    self::set_alert(self::ERROR, $msg, $idx);
  }

  public static function set_success($msg, $idx = '') {
    self::set_alert(self::SUCCESS, $msg, $idx);
  }

  public static function set_alert($type, $msg, $idx) {
    if ( ! in_array($type, [self::ERROR, self::SUCCESS, self::WARNING, self::INFO]))
    {
      die('Something went wrong');
    }

    if ( ! $idx)
      self::$_alerts[$type][] = $msg;
    else
      self::$_alerts[$type][$idx] = $msg;

    // set FLASHDATA
    static::set_flashdata();
  }

  public static function get_errors() {
    return self::$_alerts[self::ERROR];
  }

  public static function get_successes() {
    return self::$_alerts[self::SUCCESS];
  }

  public static function get_alerts() {
    return self::$_alerts;
  }

  /* --------------------------------------------------------------
   * FLASHDATA
   * ------------------------------------------------------------ */

  public static function set_flashdata() {
    get_instance()->session->set_flashdata(static::$_session_key, static::$_alerts);
  }

  public static function has_flashdata() {
    if ( ! isset($_SESSION[static::$_session_key]) ) return false;

    $has = false;
    foreach ($_SESSION[static::$_session_key] as $alert) {
      if (count($alert)) $has = true;
    }
    return $has;
  }

  public static function get_flashdata() {
    return static::has_flashdata() ? $_SESSION[static::$_session_key] : false;
  }

  /* --------------------------------------------------------------
   * DISPLAY
   * ------------------------------------------------------------ */

  public static function display_errors() {
    if (static::has_flashdata()) {
      $errors = isset($_SESSION[static::$_session_key][static::ERROR]) ?
                    $_SESSION[static::$_session_key][static::ERROR] : [];
      if (count($errors))
        view()->display_partial('alerts/errors', ['errors'=>$errors]);
    }
  }

  public static function display_successes() {
    if (static::has_flashdata()) {
      $successes = isset($_SESSION[static::$_session_key][static::SUCCESS]) ?
                    $_SESSION[static::$_session_key][static::SUCCESS] : [];
      if (count($successes))
        view()->display_partial('alerts/successes', ['successes'=>$successes]);
    }
  }

  public static function display() {
    self::display_errors();
    self::display_successes();
  }
}
