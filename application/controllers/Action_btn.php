<?php

class Action_btn extends App\Controller {

  public function save($model) {
    if (post('status') == 0) {
      model($model)->save($_POST, post('get_by'));
    }
    else {
      model($model)->delete_by(post('delete_by'));
    }
  }

  public function job_user() {
    model('job_user')->save([
      post('field') => post('status') == 0 ? 1 : 0
    ], [
      'job_id' => post('job_id'),
      'user_id' => post('user_id')
    ]);
  }
}
