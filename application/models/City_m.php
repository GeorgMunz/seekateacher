<?php

class City_m extends App\Model {

  public function get_name($id) {
    $city = $this->get($id);
    if ($city) return $city->name;
    return '';
  }

}
