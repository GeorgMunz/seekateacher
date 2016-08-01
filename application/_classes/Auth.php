<?php
namespace App;

class Auth {

  protected static $_session_key = 'xc_auth';

  public static function set_session($user_id) {
    $user = model('user')->get($user_id);
    $autho = model('user_autho_group')->get_all_idx($user_id);
    $profile = model('user_profile')->get_by('user_id', $user_id);

    $data = [
      self::$_session_key => [
        'authe' => $user,
        'autho' => $autho,
        'profile' => $profile
      ]
    ];
    session()->set_userdata($data);
  }

  public static function id() {
    return isset($_SESSION[self::$_session_key]) ? $_SESSION[self::$_session_key]['authe']->id : false;
  }

  public static function autho() {
    return isset(self::session()['autho']) ? self::session()['autho'] : ['guest'];
  }

  public static function profile($field = '') {
    return ! $field ? self::session()['profile'] : self::session()['profile']->$field;
  }

  public static function authe($field = '') {
    return ! $field ? self::session()['authe'] : self::session()['authe']->$field;
  }


  public static function session() {
    return isset($_SESSION[self::$_session_key]) ?
            $_SESSION[self::$_session_key] : null;
  }

  public static function is($key, $user_id = '') {
    if ( ! $user_id)
      return in_array($key, self::autho());

    $authos = model('user_autho_group')->get_all_idx($user_id);
    return in_array($key, $authos);
  }

  public static function is_self($id) {
    return self::id() == $id;
  }

  public static function layout($message = false) {
    if ($message) $nav = 'message';
    else $nav = 'private-profile';

    if (self::is('tch')) {
      view()->set_layout("teacher-$nav");
    }
    else if (self::is('rec')) {
      view()->set_layout("recruiter-$nav");
    }
    else {
      die('Auth Layout error');
    }
  }
}
