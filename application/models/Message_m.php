<?php

class Message_m extends App\Model {

  public $fsp_base = '/message/listing/all';

  protected $__events_callbacks_always = [
    'before_insert' => 'created_at'
  ];

  public function attach_threads($row) {
    $row->threads = model('message_thread')
    ->after_get('attach_user')
    ->get_many_by('message_id', $row->id);

    return $row;
  }

  public function attach_excerpt($row) {
    $row->excerpt = excerpt($row->message, 50);
    return $row;
  }

  public function attach_url($row) {
    $row->url = "/message/detail/{$row->id}";
    return $row;
  }

  public function attach_author($row) {
    if ($row->sender_id == App\Auth::id()) {
      $other_id = $row->receiver_id;
      $row->self = 'sender';
      $row->author = 'Me';
    }
    else {
      $other_id = $row->sender_id;
      $row->self = 'receiver';
      $row->author = model('user_profile')
      ->get_by('user_id', $other_id)->name;
    }
    return $row;
  }

  public function attach_sender($row) {
    $row->sender = model('user')->user_profile()->get($row->sender_id);
    return $row;
  }

  public function attach_receiver($row) {
    $row->receiver = model('user')->user_profile()->get($row->receiver_id);
    return $row;
  }

  public function attach() {
    return $this->after_get('attach_sender', 'attach_url', 'attach_excerpt');
  }

  public function query_listing($type, $self_id) {
    switch ($type) {
      case 'all':
        model('message')
        ->group_start()
          ->where('receiver_id', $self_id)
          ->where('receiver_trash', false)
        ->group_end()
        ->or_group_start()
          ->where('sender_id', $self_id)
          ->where('sender_trash', false)
        ->group_end();
        break;

      case 'inbox':
        model('message')->where('receiver_id', $self_id)
        ->where('receiver_trash', false);
        break;

      case 'sent':
        model('message')->where('sender_id', $self_id)
        ->where('sender_trash', false);
        break;

      case 'unread':
        model('message')->where('receiver_id', $self_id)
        ->where('viewed', false);
        break;

      case 'trash':
        model('message')
        ->group_start()
          ->where('receiver_id', $self_id)
          ->where('receiver_trash', true)
          ->where('receiver_deleted', false)
        ->group_end()
        ->or_group_start()
          ->where('sender_id', $self_id)
          ->where('sender_trash', true)
          ->where('sender_deleted', false)
        ->group_end();
        break;
    }
    return $this;
  }

  public function unread($self_id) {
    return $this->listing('unread', $self_id)->count_all();
  }

  public function sender_or_receiver($message_id, $user_id) {
    $message = $this->get($message_id);
    return ($message->sender_id == $user_id) ? 'sender' : 'receiver';
  }

}
