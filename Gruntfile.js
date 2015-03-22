module.exports = function(grunt) {

	grunt.initConfig({
	    	sass: {
		      dist: {
		      	options: {
		      		style: 'compressed'
		      	},
		      	files: {
		           		'resources/css/main.css': 'resources/css/main.sass'
		          	}
		      }
	    	},
	    	watch: {
		    	files: ['resources/css/*.sass', 'resources/css/**/*.sass'],
			tasks: ['sass']
		}
	});

  	grunt.loadNpmTasks('grunt-contrib-sass');
  	grunt.loadNpmTasks('grunt-contrib-watch');

  	grunt.registerTask('default', ['sass', 'watch']);

};