'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var browerSync = require('browser-sync').create();
var browserify = require('browserify');
var watchify = require('watchify');
var fs = require('fs');

var b = browserify({
  entries: ['./assets/js/main.js'],
  cache: {},
  packageCache: {},
  plugin: [watchify]
});

b.on('update', bundle);
bundle();

function bundle() {
  b.bundle().pipe(fs.createWriteStream('./assets/js/bundle.js'));
}

gulp.task('scss', function(){
 return gulp.src('./assets/scss/main.scss')
  .pipe(sourcemaps.init())
  .pipe(sass().on('error', sass.logError))
  .pipe(sourcemaps.write('./'))
  .pipe(gulp.dest('./assets/css/'))
  .pipe(browerSync.reload({
    stream: true
  }));
});


gulp.task('browerSync', function(){
  browerSync.init({
    proxy: 'dev.v1.seekateacher.com'
  });
});


gulp.task('watch', ['browerSync', 'scss'], function(){
  gulp.watch('./assets/scss/**/*.scss', ['scss']);
  gulp.watch('./assets/js/bundle.js', browerSync.reload);
  gulp.watch('./pages/**/*.php', browerSync.reload);
  gulp.watch('./layouts/**/*.php', browerSync.reload);
  gulp.watch('./partials/**/*.php', browerSync.reload);
});
