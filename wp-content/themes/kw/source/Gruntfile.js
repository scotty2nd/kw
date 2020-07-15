module.exports = function (grunt) {
    // load all grunt tasks
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-sass');

    grunt.initConfig({
        sass:        {
            dist: {
                files: {
                    'css/main.css' : 'scss/main.scss'
                }
            }
        },
        cssmin: {
            target: {
                files: {
                    '../css/main.min.css': ['css/main.css']
                }
            }
        },
        uglify: {
            target: {
                files: {
                    '../js/main.min.js': ['js/main.js', 'js/vendor/slick.min.js', 'js/vendor/jquery.magnific-popup.min.js']
                }
            }
        },
        watch: {
            css: {
                files: 'scss/*.scss',
                tasks: ['sass', 'cssmin']
            },
            scripts: {
                files: 'js/*.js',
                tasks: ['uglify']
            }
        }
    });
    grunt.registerTask('build', ['sass', 'cssmin', 'uglify']);
    grunt.registerTask('dev', ['sass', 'cssmin', 'uglify', 'watch']);
};
