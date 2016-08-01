<?php

class Job_user_m extends App\Model {

  public function applied($job_id, $user_id) {
    return $this->get_by([
      'job_id' => $job_id,
      'user_id' => $user_id,
      'applied' => 1
    ]) ? 1 : 0;
  }

  public function status($field, $job_id, $user_id) {
    return $this->get_by([
      'job_id' => $job_id,
      'user_id' => $user_id,
      $field => 1
    ]) ? 1 : 0;
  }

}
