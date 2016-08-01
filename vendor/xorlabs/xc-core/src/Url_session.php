<?php
namespace XORLabs\XC\Core;

class Url_session {

  /**
  * The session key
  */
  protected static $_session_key = 'xc_url_session';

  /**
  * No of urls to remember
  */
  protected static $_num_urls = 10;

  /**
   * add only recent $num_urls urls to session
   */
  public static function record($url) {
    $url = '/' . $url;
    if ( ! isset($_SESSION[static::$_session_key]) ) {
      $_SESSION[static::$_session_key] = (object) ['urls' => []];
    }
    // prevent refreshed urls to get added
    if (static::valid($url))
      $_SESSION[static::$_session_key]->urls[] = $url;

    if (static::num_saved_urls() > static::$_num_urls)
      array_shift($_SESSION[static::$_session_key]->urls);
  }

  /**
   * get the saved url by index
   */
  public static function url($index) {
    return isset($_SESSION[static::$_session_key]->urls[$index]) ?
              $_SESSION[static::$_session_key]->urls[$index] : false;
  }

  /**
   * get last saved
   * @return string return the last saved url
   */
  public static function last() {
    $last = static::num_saved_urls() - 1;
    return static::url($last);
  }

  /**
   * get the prev saved url
   */
  public static function prev() {
    $prev = static::num_saved_urls() - 2;
    return static::url($prev);
  }

  /**
   * get the total num of saved urls
   */
  public static function num_saved_urls() {
    return count($_SESSION[static::$_session_key]->urls);
  }

  public static function urls() {
    return $_SESSION[static::$_session_key];
  }

  /**
   * test valid url
   * @param  string $url url to test for
   * @return bool      valid or not
   */
  public static function valid($url) {
    if (static::last() == $url) return false;
    if ($url == 'favicon.ico') return false;
    if (strpos($url, '.')) return false;
    return true;
  }
}
