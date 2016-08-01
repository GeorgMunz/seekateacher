<?php

function view($page = '', $data = []) {
  if ($page)
    return App\View::get_instance()->build($page, $data);
  else
    return App\View::get_instance();
}

function view_data() {
  $locations = model('city')->dropdown('name', 'name');
  $locations = array_merge([''=>''], $locations);
  $job_organizations = model('option')->dropdown('job_organizations');
  $profile_deactivate_reasons = model('option')->values('profile_deactivate_reasons');
  $job_subjects = model('option')->values('job_subjects');
  view()->data(get_defined_vars());
}

function build_404() {
  echo view('404');
  exit();
}

function active($link) {
  return view()->is_active($link);
}

function page() {
  echo view()->template['page'];
}

function partial($file, $data = []) {
  echo view()->display_partial($file, $data);
}

function layout($arg) {
  if (is_string($arg) && $arg == 'c1') {
    $arg = ['tch'=>'teacher-profile','rec'=>'recruiter-profile'];
  }
  if (is_array($arg)) {
    // setting layout based upon the current user
    foreach ($arg as $autho_group => $file) {
      if (auth('is', $autho_group)) {
        view()->set_layout($file);
        return true;
      }
    }
  }
  else {
    view()->set_layout($arg);
  }
}

function body_classes() {
  echo view()->bc->display();
}

function head() {
  echo view()->template['head'];
  echo view()->template['foot']; // quick fix
}

function foot() {
  // echo view()->template['foot'];
}

function reg_css($arr) {
  view()->css_arr = array_merge(view()->css_arr, $arr);
}

function reg_js($arr) {
  view()->js_arr = array_merge(view()->js_arr, $arr);
}

function css() {
  foreach (func_get_args() as $arg) {
    view()->css($arg);
  }
}

function js() {
  foreach (func_get_args() as $arg) {
    view()->js($arg);
  }
}

function cj() {
  foreach (func_get_args() as $arg) {
    view()->cj($arg);
  }
}

function theme_url($theme = '') {
  return (!$theme) ? '/seek/public_html/themes/'.view()->get_theme() : "/seek/public_html/themes/$theme/";
  // return (!$theme) ? '/themes/'.view()->get_theme() : "/themes/$theme/";//Custom by Rosy
}

function base_url()
{
	return '/seek/public_html';
}

function url($key) {
  $urls = [
    // Auth
    'forgot-password' => '/auth/forgot-password',  
    'auth-bd-post' => '/auth/basic-detail-post',
    'f-su' => '/auth/basic-detail',
    'f-su-2' => '/auth/sign-up',
    'f-su-3' => '/auth/basic-detail-post',
    'f-si' => '/auth/login-post',
    'sign-up' => '/auth/sign-up',
    'sign-in' => '/auth/login',
    'watchlist' => '/watchlist/listing/teachers',
    'watchlist-jobs' => '/watchlist/listing/jobs',
    'watchlist-courses' => '/watchlist/listing/courses',
    'watchlist-education-companies' => '/watchlist/listing/ec',
    'watchlist-supply-agencies' => '/watchlist/listing/sa',
    // Message
    'message-all' => '/message/listing/all',
    'message-inbox' => '/message/listing/inbox',
    'message-sent' => '/message/listing/sent',
    'message-unread' => '/message/listing/unread',
    'message-trash' => '/message/listing/trash',
    'message-compose' => '/message/compose',
    'message-compose-post' => '/message/compose-post',
    // Job
    'job-form-1' => '/job/form-1',
    'job-form-1-post' => '/job/form-1-post',
    'job-form-2-post' => '/job/form-2-post',
    'job-listing' => '/job/listing',
    'job-applied' => '/job/applied',
    'job-manage' => '/job/manage',
    // Teacher
    'teacher-listing' => '/teacher/listing',
    'teacher-recommend' => '/teacher/recommend',
    // Recruiter
    'recruiter-listing/education-companies' => '/recruiter/listing/ec',
    'recruiter-listing/supply-agencies' => '/recruiter/listing/sa',
    // Course
    'course-form' => '/course/form',
    'course-form-post' => '/course/form-post',
    'course-manage' => '/course/manage',
    'course-listing' => '/course/listing',
    // Group
    'group-sc' => '/group/listing/sc',
    'group-mi' => '/group/listing/mi',
    'group-form' => '/group/form',
    'group-form-post' => '/group/form-post',
    'group-member-add' => '/group/member-add-ajax',
    'group-comment-post' => '/group/comment-post-ajax',
    // Event
    'community-event-listing' => '/community/listing/'.Community_m::TYPE_EVENT,
    'community-event-form' => '/community/form/'.Community_m::TYPE_EVENT,
    'community-event-form-post' => '/community/form-post/'.Community_m::TYPE_EVENT,
    // Request
    'community-request-listing' => '/community/listing/'.Community_m::TYPE_REQUEST,
    'community-request-form' => '/community/form/'.Community_m::TYPE_REQUEST,
    'community-request-form-post' => '/community/form-post/'.Community_m::TYPE_REQUEST,
    // Recommendation
    'community-recom-listing' => '/community/listing/'.Community_m::TYPE_RECOMMENDATION,
    'community-recom-form' => '/community/form/'.Community_m::TYPE_RECOMMENDATION,
    'community-recom-form-post' => '/community/form-post/'.Community_m::TYPE_RECOMMENDATION,
    // Community
    'community-comment-form-post' => '/community/comment-form-post-ajax',
    // Pages
    'about-us' => '/page/about'
  ];

  if ($key == 'group-view-members') {
    return '/group/members/' . func_get_arg(1);
  }

  return $urls[$key];
}
