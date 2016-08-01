<?php

class Autho_group_m extends App\Model {

  public function recs() {
    $rec_id = $this->id('idx', 'rec');
    return $this->get_many_by('parent', $rec_id);
  }

  public function tch_id() {
    return $this->id('idx', 'tch');
  }

  public function rec_ids() {
    return array_map(function($rec){
      return $rec->id;
    }, $this->recs());
  }

  public function recs_kv() {
    $recs = $this->recs();
    $kv = [];
    foreach ($recs as $rec) {
      $kv[$rec->idx] = $rec->name;
    }
    return $kv;
  }

  /**
   * ['reg', 'rec', 'la']
   * return group name
   */
  public function recruiter_group_name() {
    $idxs = auth('autho');
    $recs = $this->recs();
    foreach ($idxs as $idx) {
      foreach ($recs as $rec) {
        if ($rec->idx == $idx) {
          return $rec->name;
        }
      }
    }
  }
}
