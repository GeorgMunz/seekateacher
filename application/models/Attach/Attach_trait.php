<?php

trait Attach_trait {

  public function attach_user($row) {
    if (!$row) return;
    $row->user = model('user')
    ->user_profile()
    ->get($row->user_id);

    $row->user->public_profile = 'public';

    if ($row->user->org_logo) {
      $row->user->org_logo = model('upload')->get($row->user->org_logo)->uri;
    }

    return $row;
  }

  public function attach_rec_type($row) {
    $user_id = $row->id;
    $uags = model('user_autho_group')
    ->map('autho_group_id')
    ->get_many_by('user_id', $user_id);

    $rec_ids = model('autho_group')->rec_ids();
    foreach ($uags as $uag) {
      if (in_array($uag, $rec_ids)) {
        $row->rec_type = model('autho_group')->get($uag)->name;
      }
    }

    return $row;
  }

}
