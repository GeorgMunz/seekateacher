<?php

reg_css([
  'bootstrap' => [theme_url().'/node_modules/bootstrap/dist/css/bootstrap.css', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'],
  'bootstrap-switch' => [theme_url().'/node_modules/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css'],
  'animate.css' => [theme_url().'/node_modules/animate.css/animate.min.css'],
  'slick' => [theme_url().'/node_modules/slick-carousel/slick/slick.css'],
  'slick-theme' => [theme_url().'/node_modules/slick-carousel/slick/slick-theme.css'],
  'select2' => [theme_url().'/node_modules/select2/dist/css/select2.css'],
  'ekko-lightbox' => [theme_url().'/node_modules/ekko-lightbox/dist/ekko-lightbox.min.css'],
  'typeaheadjscss' => [theme_url().'/node_modules/typeahead.js-bootstrap-css/typeaheadjs.css'],
  'datetimepicker' => [theme_url().'/node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'],
  'theme' => [theme_url().'/assets/css/main.css'],
]);


reg_js([
  'jquery' => [theme_url().'/node_modules/jquery/dist/jquery.min.js', '//code.jquery.com/jquery-2.1.4.min.js'],
  'angular' =>  [theme_url().'/node_modules/angular/angular.min.js'],
  'bootstrap' => [theme_url().'/node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js'],
  'bootstrap-switch' => [theme_url().'/node_modules/bootstrap-switch/dist/js/bootstrap-switch.min.js'],
  'slick' => [theme_url().'/node_modules/slick-carousel/slick/slick.min.js'],
  'bootbox' => [theme_url().'/node_modules/bootbox/bootbox.min.js'],
  'moment' => [theme_url().'/node_modules/eonasdan-bootstrap-datetimepicker/node_modules/moment/min/moment.min.js'],
  'select2' => [theme_url().'/node_modules/select2/dist/js/select2.min.js'],
  'datetimepicker' => [theme_url().'/node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', '', ['moment']],
  'tinymce' => [theme_url().'/node_modules/tinymce/tinymce.min.js'],
  'form-validator' => [theme_url().'/node_modules/jquery-form-validator/form-validator/jquery.form-validator.min.js'],
  'recaptcha' => ['https://www.google.com/recaptcha/api.js'],
  'ekko-lightbox' => [theme_url().'/node_modules/ekko-lightbox/dist/ekko-lightbox.min.js'],
  'typeahead' => [theme_url().'/node_modules/typeahead.js/dist/typeahead.bundle.min.js'],
  'theme' => [theme_url().'/assets/js/bundle.js'],
]);

// default
js('jquery', 'angular', 'moment', 'tinymce', 'form-validator', 'typeahead', 'bootstrap', 'bootbox', 'ekko-lightbox');
css('slick-theme', 'typeaheadjscss', 'animate.css');
cj('select2', 'bootstrap-switch', 'slick', 'datetimepicker','theme');
