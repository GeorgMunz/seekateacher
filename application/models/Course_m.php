<?php
require_once __DIR__ . '/Attach/Attach_trait.php';

class Course_m extends App\Model {
  use Attach_trait;

  // 0 => how | 1 => model
  public $fsp = [
    'location' => ['', 'user_profile'],
    'search' => ['like:title|detail']
  ];

  public function attach_url($row) {
    $row->url = "/course/detail/$row->id";
    return $row;
  }

  public function attach_price_f($row) {
    $row->price_f = '£ ' . $row->price;
    return $row;
  }

  public function attach_actions($row) {
    if (auth('id') == $row->user_id) {
      $row->actions = true;
      $row->edit_url = '/course/form/'.$row->id;
    }
    return $row;
  }

  public function attach_uploads($row) {
    $row->upload_cover_img = model('upload')->get_by('id', $row->cover_img);
    return $row;
  }

  public function attach_actions_2($row) {
    // check present status
    $status = count(model('watchlist_course')
    ->get_by([
      'self_id' => auth('id'),
      'course_id' => $row->id,
    ])) ? 1 : 0;
    $row->action_watchlist = json_encode([
      'url' => '/action-btn/save/watchlist_course',
      'self_id' => auth('id'),
      'course_id' => $row->id,
      'status' => $status,
      'text-0' => 'Add to Watchlist',
      'text-1' => 'Un-watch',
      'delete_by' => ['course_id'=>$row->id,'self_id'=>auth('id')],
      'get_by' => ['course_id'=>$row->id,'self_id'=>auth('id')],
    ]);
    $row->action_watchlist_status = $status;

    return $row;
  }


  public function attach() {
    return $this->after_get('attach_url', 'attach_price_f', 'attach_actions', 'attach_user', 'attach_actions_2', 'attach_uploads');
  }
}
