<?php
namespace XORLabs\XC\Core;

class Form_Validation extends \CI_Form_validation {

  protected static $_instance;

  public static function get_instance() {
    if ( ! self::$_instance) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  public function set_validation($arr) {
    foreach ($arr as $field => $rules) {
      $label = ucfirst($field);
      $this->set_rules($field, $label, $rules);
    }
  }

}
