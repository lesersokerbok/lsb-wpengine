'use strict';
module.exports = function(grunt) {
  // Load all tasks
  require('load-grunt-tasks')(grunt);
  // Show elapsed time
  require('time-grunt')(grunt);

  var basePrefix = 'wp-content/themes/lsb-base-theme/';
  var baseDevFilesCSSOutput = basePrefix + 'assets/css/main.css';
  var baseBuildFilesCSSOutput = basePrefix + 'assets/css/main.min.css';
  var baseDevFilesJSOutput = basePrefix + 'assets/js/scripts.js';
  var baseBuildFilesJSOutput = basePrefix + 'assets/js/scripts.min.js';
  var baseVersionDefaultFilesKey = basePrefix + 'lib/scripts.php';


  var jsFileList = [
    basePrefix + 'assets/vendor/bootstrap/js/transition.js',
    basePrefix + 'assets/vendor/bootstrap/js/alert.js',
    basePrefix + 'assets/vendor/bootstrap/js/button.js',
    basePrefix + 'assets/vendor/bootstrap/js/carousel.js',
    basePrefix + 'assets/vendor/bootstrap/js/collapse.js',
    basePrefix + 'assets/vendor/bootstrap/js/dropdown.js',
    basePrefix + 'assets/vendor/bootstrap/js/modal.js',
    basePrefix + 'assets/vendor/bootstrap/js/tooltip.js',
    basePrefix + 'assets/vendor/bootstrap/js/popover.js',
    basePrefix + 'assets/vendor/bootstrap/js/scrollspy.js',
    basePrefix + 'assets/vendor/bootstrap/js/tab.js',
    basePrefix + 'assets/vendor/bootstrap/js/affix.js',
    basePrefix + 'assets/js/plugins/*.js',
    basePrefix + 'assets/js/_*.js'
  ];

  grunt.initConfig({
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        basePrefix + 'assets/js/*.js',
        '!' + basePrefix + 'assets/js/scripts.js',
        '!' + basePrefix + 'assets/**/*.min.*'
      ]
    },
    less: {
      dev: {
        files: {
          'wp-content/themes/lsb-base-theme/assets/css/main.css': [
            basePrefix + 'assets/less/main.less'
          ]
        },
        options: {
          compress: false,
          // LESS source map
          // To enable, set sourceMap to true and update sourceMapRootpath based on your install
          sourceMap: true,
          sourceMapFilename: 'main.css.map',
          sourceMapRootpath: basePrefix + 'assets/css/'
        }
      },
      build: {
        files: {
          'wp-content/themes/lsb-base-theme/assets/css/main.min.css': [
            basePrefix + 'assets/less/main.less'
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
        dest: basePrefix + 'assets/js/scripts.js',
      },
    },
    uglify: {
      dist: {
        files: {
          'wp-content/themes/lsb-base-theme/assets/js/scripts.min.js': [jsFileList]
        }
      }
    },
    autoprefixer: {
      options: {
        browsers: ['last 2 versions', 'ie 8', 'ie 9', 'android 2.3', 'android 4', 'opera 12']
      },
      dev: {
        options: {
          map: {
            prev: basePrefix + 'assets/css/'
          }
        },
        src: basePrefix + 'assets/css/main.css'
      },
      build: {
        src: basePrefix + 'assets/css/main.min.css'
      }
    },
    modernizr: {
      build: {
        devFile: basePrefix + 'assets/vendor/modernizr/modernizr.js',
        outputFile: basePrefix + 'assets/js/vendor/modernizr.min.js',
        files: {
          'src': [
            [basePrefix + 'assets/js/scripts.min.js'],
            [basePrefix + 'assets/css/main.min.css']
          ]
        },
        uglify: true,
        parseFiles: true
      }
    },
    version: {
      default: {
        options: {
          format: true,
          length: 32,
          manifest: basePrefix + 'assets/manifest.json',
          querystring: {
            style: 'roots_css',
            script: 'roots_js'
          }
        },
        files: {
         'wp-content/themes/lsb-base-theme/lib/scripts.php': basePrefix + 'assets/{css,js}/{main,scripts}.min.{css,js}'
        }
      }
    },
    watch: {
      less: {
        files: [
          basePrefix + 'assets/less/*.less',
          basePrefix + 'assets/less/**/*.less'
        ],
        tasks: ['less:dev', 'autoprefixer:dev']
      },
      js: {
        files: [
          jsFileList,
          '<%= jshint.all %>'
        ],
        tasks: ['jshint', 'concat']
      },
      livereload: {
        // Browser live reloading
        // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
        options: {
          livereload: false
        },
        files: [
          basePrefix + 'assets/css/main.css',
          basePrefix + 'assets/js/scripts.js',
          basePrefix + 'templates/*.php',
          basePrefix + '*.php'
        ]
      }
    }
  });

  // Register tasks
  grunt.registerTask('default', [
    'dev'
  ]);
  grunt.registerTask('dev', [
    'jshint',
    'less:dev',
    'autoprefixer:dev',
    'concat'
  ]);
  grunt.registerTask('build', [
    'jshint',
    'less:build',
    'autoprefixer:build',
    'uglify',
    'modernizr',
    'version'
  ]);
};
