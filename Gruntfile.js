module.exports = function(grunt) {

  var config = {
    bower_path: 'bower_components',
    build_path: '.build',

    assets_less: 'assets/less',
    assets_js: 'assets/js',

    css: 'public/css',
    js: 'public/js',
    images: 'public/img',
    fonts: 'public/font'
  };


  grunt.registerTask('default', [ 'concat', 'copy', 'less', 'cssmin', 'clean' ]);
  grunt.registerTask('angular', [ 'concat:angular', 'uglify:build', 'copy:angular', 'clean' ]);
 
  grunt.initConfig({
    config: config,

    pkg: grunt.file.readJSON('package.json'),

    concat: {
      options: {
        separator: ';'
      },
      angular: {
        src: [
          '<%= config.assets_js %>/app.js',
          '<%= config.assets_js %>/services.js',
          '<%= config.assets_js %>/controllers.js',
        ],
        dest: '<%= config.build_path %>/mashtag.js'
      },
      bootstrap: {
        src: [
          '<%= config.bower_path %>/bootstrap/js/alert.js',
          '<%= config.bower_path %>/bootstrap/js/button.js',
          '<%= config.bower_path %>/bootstrap/js/collapse.js',
          '<%= config.bower_path %>/bootstrap/js/dropdown.js',
          '<%= config.bower_path %>/bootstrap/js/modal.js',
          '<%= config.bower_path %>/bootstrap/js/tooltip.js',
          '<%= config.bower_path %>/bootstrap/js/popover.js',
          '<%= config.bower_path %>/bootstrap/js/tab.js',
          '<%= config.bower_path %>/bootstrap/js/transition.js'
        ],
        dest: '<%= config.build_path %>/bootstrap.js'
      },
    },

    uglify: {
      options: {
        compress: true,
        mangle: false,
        warnings: false,
        preserveComments: 'some'
      },
      build: {
        files: [{
            expand: true,
            src: '**/*.js',
            dest: '<%= config.js %>',
            cwd: '<%= config.build_path %>',
            ext: '.min.js'
        }]
      }
    },


    less: {
      bootstrap: {
        files: {
          "<%= config.build_path %>/bootstrap.css": "<%= config.assets_less %>/mashtag.less"
        }
      },
    },


    copy: {
      angular: {
       files: [{
         src: '<%= config.bower_path %>/angular/angular.min.js',
         dest: '<%= config.js %>/angular.min.js'
       },
       {
         src: '<%= config.bower_path %>/angular/angular.min.js.map',
         dest: '<%= config.js %>/angular.min.js.map'
       },
       {
         src: '<%= config.bower_path %>/angular-resource/angular-resource.min.js',
         dest: '<%= config.js %>/angular-resource.min.js'
       },
       {
         src: '<%= config.bower_path %>/angular-resource/angular-resource.min.js.map',
         dest: '<%= config.js %>/angular-resource.min.js.map'
       }]
      }
    },


    cssmin: {
      minify: {
        expand: true,
        cwd: '<%= config.build_path %>/',
        src: ['*.css', '!*.min.css'],
        dest: '<%= config.css %>/',
        ext: '.min.css'
      }
    },


    watch: {
      js: {
        files: [
            '<%= config.assets_js %>/*.js',
            '!<%= config.assets_js %>/*.min.js'
        ],
        tasks: ['concat', 'uglify', 'clean'],
        options: {
          //livereload: true,
        }
      },

      css: {
        files: ['<%= config.assets_less %>/*.less'],
        tasks: ['less', 'cssmin', 'clean'],
        options: {
          //livereload: true,
        }
      }
    },

    clean: {
      build: {
        src: [ '<%= config.build_path %>' ]
      },
    },

  });
 
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-watch');
 
};