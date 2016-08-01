<?php

function session() {
  return get_instance()->session;
}

function sess($field) {
  if ($field=='profile_pic') {
    return auth('profile', 'profile_pic');
  }
}
