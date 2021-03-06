/*

 */

/*global module */

module.exports = function (grunt) {
    'use strict';

    grunt.initConfig({
        jshint: {
            options: {
                jshintrc: '.jshintrc'
            },
            all: [
                'Gruntfile.js',
                'js/cors/*.js',
                'js/*.js',
                'server/node/server.js',
                'test/test.js'
            ]
        }
    });

    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-bump-build-git');
    grunt.registerTask('test', ['jshint']);
    grunt.registerTask('default', ['test']);

};
