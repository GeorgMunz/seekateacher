module.exports = function(grunt) {
  // Load all tasks
  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    less: {
      dev: {
        files: {
          'assets/css/main.css': ['assets/less/main.less']
        },
        options: {
          compress: false,
          sourceMap: true,
          sourceMapFilename: 'assets/css/main.css.map',
          sourceMapRootpath: 'assets/css/'
        }
      },
      build: {
        files: {
          'assets/css/main.min.css': ['assets/less/main.less']
        },
        options: {
          compress: true
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
          'assets/js/main.js'
        ],
        tasks: ['browserify:dist']
      }
    },
    php: {
      dev: {
        options: {
          hostname: 'http://dev.v1.seekateacher.com/',
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
            'assets/js/bundle.js',
            'index.php',
            'pages/*.php',
            'partials/*.php'
          ]
        },
        options: {
          watchTask: true,
          proxy: '<%= php.dev.options.hostname %>'
        }
      }
    },
    uglify: {
      build: {
        files: {
          'assets/js/main.min.js': 'assets/js/main.js'
        }
      }
    },
    browserify: {
      dist: {
        files: {
          'assets/js/bundle.js': ['assets/js/main.js']
        }
      }
    },
    assets_versioning: {
      css: {
        options: {
          post: true,
          tasks: ['less:build'],
          versionsMapFile: 'assets/css_manifest.json'
        }
      },
      js: {
        options: {
          tasks: ['uglify:build'],
          versionsMapFile: 'assets/js_manifest.json'
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
    'less:dev'
  ]);
  grunt.registerTask('build', [
    'less:build',
    'autoprefixer:build'
  ]);
};
