<?php
namespace XORLabs\XC\Core;

class Form {

  protected static $_session_key = 'xc_form';

  public static function valid($rules) {
    Form_validation::get_instance()->set_validation($rules);
    return Form_validation::get_instance()->run();
  }

  public static function set_flashdata() {
    get_instance()->session->set_flashdata(static::$_session_key, $_POST);
  }

  public static function get_flashdata() {
    return isset($_SESSION[static::$_session_key]) ? $_SESSION[static::$_session_key] : false;
  }

  public static function repopulate() {
    $_POST = static::get_flashdata();
  }

  public static function error_string() {
    return Form_validation::get_instance()->error_string();
  }

  public static function validate($rules) {
    if ( ! static::valid($rules)) {
      Alert::set_error(static::error_string());
      static::set_flashdata();
      Alert::set_flashdata();

      $_POST = $repopulate;
      redirect(Url_Session::prev());
    }
  }
}
