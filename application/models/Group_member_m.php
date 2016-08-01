<?php

class Group_member_m extends App\Model {

  public function attach_is_member($row, $group_id) {
    $row->is_member = $this->get_by([
      'group_id' => $group_id,
      'user_id' => $row->id
    ]) ? true : false;

    $row->data_module = json_encode([
      'user_id'=>$row->id,
      'is_member'=>$row->is_member
    ]);

    $row->add_member_url = "/group/member_add/$group_id/$row->id";

    return $row;
  }

}
