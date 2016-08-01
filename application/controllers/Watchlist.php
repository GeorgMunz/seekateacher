<?php

class Watchlist extends App\Controller {

  public function listing($wl) {

    if ($wl == 'teachers') {
      $page = 'teachers';
      $watchlist = model('watchlist_user')
      ->map('user_id')
      ->get_many_by('self_id', auth('id'));
      $data = ['tchs'=>[]];
      if (count($watchlist)) {
        $data = [
          'tchs' => model('user')
          ->teachers()
          ->attach()
          ->get_many_by('users.id', $watchlist)
        ];
      }
    }
    else if ($wl == 'jobs') {
      $page = 'jobs';
      $data = [
        'jobs' => model('job')
        ->select('*')
        ->join('job_user', 'job_id', 'id')
        ->where('user_id', auth('id'), 'job_user')
        ->where('saved', 1, 'job_user')
        ->attach()
        ->get_all(),
      ];
    }
    else if ($wl == 'courses') {
      $page = 'courses';
      $watchlist = model('watchlist_course')
      ->map('course_id')
      ->get_many_by('self_id', auth('id'));
      $data = [
        'courses' => count($watchlist) ? model('course')
        ->attach()
        ->get_many_by('courses.id', $watchlist) : []
      ];
    }
    else if ($wl == 'ec') {
      $page = 'recruiters';
      $data = [
        'recs' => model('user')
        ->recruiters('ec')
        ->after_get('attach_rec_type')
        ->attach()
        ->join('watchlist_user', 'user_id', 'id')
        ->where('self_id', auth('id'), 'watchlist_user')
        ->get_all()
      ];
    }
    else if ($wl == 'sa') {
      $page = 'recruiters';
      $data = [
        'recs' => model('user')
        ->recruiters('sa')
        ->after_get('attach_rec_type')
        ->attach()
        ->join('watchlist_user', 'user_id', 'id')
        ->where('self_id', auth('id'), 'watchlist_user')
        ->get_all()
      ];
    }

    view("watchlist/{$page}", $data);
  }
}
