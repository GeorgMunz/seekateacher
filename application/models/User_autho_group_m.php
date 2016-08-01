<?php

class User_autho_group_m extends App\Model {

  public function get_all_idx($user_id) {
    $authos = $this->join('autho_group', 'id', 'autho_group_id')
   ->select('idx', 'autho_group')
   ->where('user_id', $user_id)
   ->map('idx')
   ->get_all();

    return $authos;
  }

  public function rec_type($user_id) {
    $authos = $this->get_all_idx($user_id);
    $recs = model('autho_group')->recs_kv();
    foreach ($recs as $idx => $name) {
      if (in_array($idx, $authos)) {
        return $name;
      }
    }
    return '';
  }

}
