<?php
namespace App;

class Pagination extends \CI_Pagination {

  protected static $_instance;

  public static function get_instance() {
    if ( ! self::$_instance) {

      self::$_instance = new static(Load::config('pagination'));
    }
    return self::$_instance;
  }

  public function num_pages() {
    return (int) ceil($this->total_rows / $this->per_page);
  }

  public function num_rows() {
    return $this->total_rows;
  }

}
