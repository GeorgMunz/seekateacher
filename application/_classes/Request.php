<?php
namespace App;

class Request {

  public static function validate($rules) {
    Form::validate($rules);
  }

  public static function repopulate() {
    Form::repopulate();
  }
}
