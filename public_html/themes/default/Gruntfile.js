'use strict';
module.exports = function(grunt) {
  // Load all tasks
  require('load-grunt-tasks')(grunt);
  // Show elapsed time
  require('time-grunt')(grunt);

  var jsFileList = [
    'assets/js/_xl/**/*.js',
    'assets/js/plugins/*.js',
    'assets/js/sdks/*.js',
    'assets/js/angular/controllers.js',
    'assets/js/angular/app.js',
    'assets/js/misc/**/*.js',
    'assets/js/_main.js'
  ];

  grunt.initConfig({
    less: {
      dev: {
        files: {
          'assets/css/main.css': [
            'assets/less/main.less'
          ]
        },
        options: {
          compress: false,
          // LESS source map
          // To enable, set sourceMap to true and update sourceMapRootpath based on your install
          sourceMap: true,
          sourceMapFilename: 'assets/css/main.css.map',
          sourceMapRootpath: 'assets/css/'
        }
      },
      build: {
        files: {
          'assets/css/main.min.css': [
            'assets/less/main.less'
          ]
        },
        options: {
          compress: true
        }
      }
    },
    concat: {
      options: {
        separator: ';',
      },
      dist: {
        src: [jsFileList],
        dest: 'assets/js/scripts.js',
      },
    },
    uglify: {
      dist: {
        files: {
          'assets/js/scripts.min.js': [jsFileList]
        }
      }
    },
    autoprefixer: {
      options: {
        browsers: ['last 2 versions', 'android 2.3', 'android 4', 'opera 12']
      },
      dev: {
        options: {
          map: {
            prev: 'assets/css/'
          }
        },
        src: 'assets/css/main.css'
      },
      build: {
        src: 'assets/css/main.min.css'
      }
    },
    version: {
      default: {
        options: {
          format: true,
          length: 32,
          manifest: 'assets/manifest.json',
          querystring: {
            style: 'roots_css',
            script: 'roots_js'
          }
        },
        files: {
          'index.php': 'assets/{css,js}/{main,scripts}.min.{css,js}'
        }
      }
    },
    watch: {
      less: {
        files: [
          'assets/less/*.less',
          'assets/less/**/*.less'
        ],
        tasks: ['less:dev']
      },
      js: {
        files: [
          jsFileList
        ],
        tasks: ['concat']
      }
    },
    php: {
        dev: {
            options: {
                hostname: '127.0.0.1',
                port: 9000,
                base: '.', // Project root
                keepalive: false,
                open: false
            }
        }
    },
    browserSync: {
        dev: {
            bsFiles: {
                src : [
                    'assets/css/main.css',
                    'assets/js/scripts.js',
                    'index.php',
                    'pages/*.php',
                    'partials/*.php'
                ]
            },
            options: {
                watchTask: true,
                proxy: '<%= php.dev.options.hostname %>:<%= php.dev.options.port %>'
            }
        }
    }
  });

  // Register tasks
  grunt.registerTask('default', [
    'dev'
  ]);
  grunt.registerTask('dev', [
    'php:dev',
    'browserSync:dev',
    'watch',
    'less:dev',
    'concat'
  ]);
  grunt.registerTask('build', [
    'less:build',
    'autoprefixer:build',
    'uglify',
    'version'
  ]);
};
