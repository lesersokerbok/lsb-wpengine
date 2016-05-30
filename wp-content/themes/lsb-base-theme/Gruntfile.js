'use strict';
module.exports = function(grunt) {
  // Load all tasks
  require('load-grunt-tasks')(grunt);
  // Show elapsed time
  require('time-grunt')(grunt);

  var jsBaseFileList = [
    'assets/vendor/bootstrap/js/transition.js',
    'assets/vendor/bootstrap/js/alert.js',
    'assets/vendor/bootstrap/js/button.js',
    'assets/vendor/bootstrap/js/carousel.js',
    'assets/vendor/bootstrap/js/collapse.js',
    'assets/vendor/bootstrap/js/dropdown.js',
    'assets/vendor/bootstrap/js/modal.js',
    'assets/vendor/bootstrap/js/tooltip.js',
    'assets/vendor/bootstrap/js/popover.js',
    'assets/vendor/bootstrap/js/scrollspy.js',
    'assets/vendor/bootstrap/js/tab.js',
    'assets/vendor/bootstrap/js/affix.js',
    'assets/js/plugins/*.js',
    'assets/js/_*.js'
  ];

  var lessDevBaseFiles = {};
  lessDevBaseFiles['assets/css/main.css'] = [ 'assets/less/main.less'];

  var lessBuildFiles = {};
  lessBuildFiles['assets/css/main.min.css'] = [ 'assets/less/main.less'];

  var uglifyFiles = {};
  uglifyFiles['assets/js/scripts.min.js'] = [jsBaseFileList];

  grunt.initConfig({
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        'assets/js/*.js',
        '!assets/js/scripts.js',
        '!assets/**/*.min.*'
      ]
    },
    less: {
      devBase: {
        files: lessDevBaseFiles,
        options: {
          compress: false,
          // LESS source map
          // To enable, set sourceMap to true and update sourceMapRootpath based on your install
          sourceMap: true,
          sourceMapFilename: 'assets/css/main.css.map'
          //sourceMapRootpath: 'assets/css/'
        }
      },
      buildBase: {
        files: lessBuildFiles,
        options: {
          compress: true
        }
      }
    },
    concat: {
      options: {
        separator: ';',
      },
      base: {
        src: jsBaseFileList,
        dest: 'assets/js/scripts.js',
      }
    },
    uglify: {
      dist: {
        files: uglifyFiles
      }
    },
    autoprefixer: {
      options: {
        browsers: ['last 2 versions', 'ie 8', 'ie 9', 'android 2.3', 'android 4', 'opera 12']
      },
      devBase: {
        options: {
          map: {
            prev: 'assets/css/'
          }
        },
        src: 'assets/css/main.css'
      },
      buildBase: {
        src: 'assets/css/main.min.css'
      }
    },
    modernizr: {
      base: {
        devFile: 'assets/vendor/modernizr/modernizr.js',
        outputFile: 'assets/js/vendor/modernizr.min.js',
        files: {
          'src': [
            ['assets/js/scripts.min.js'],
            ['assets/css/main.min.css']
          ]
        },
        uglify: true,
        parseFiles: true
      }
    },
		cacheBust: {
			assets: {
				options: {
					assets: ['assets/css/*.min.css', 'assets/js/*.min.js'],
					createCopies: true,
					queryString: true,
					jsonOutput: true,
					jsonOutputFilename: 'assets/manifest.json'
				},
				src: []
			}
		},
    watch: {
      less: {
        files: [
          'assets/less/*.less',
          'assets/less/**/*.less'
        ],
        tasks: ['less:devBase', 'autoprefixer:devBase',]
      },
      js: {
        files: [
          jsBaseFileList,
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
          'assets/css/main.css',
          'assets/js/scripts.js',
          'templates/*.php',
          '*.php',
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
    'less:devBase',
    'autoprefixer:devBase',
    'concat:base',
  ]);
  grunt.registerTask('dev-base', [
    'jshint',
    'less:devBase',
    'autoprefixer:devBase',
    'concat:base',
  ]);
  grunt.registerTask('build', [
    'jshint',
    'less:buildBase',
    'autoprefixer:buildBase',
    'uglify',
    'modernizr:base',
    'cacheBust:assets'
  ]);
};
