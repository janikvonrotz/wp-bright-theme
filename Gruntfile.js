module.exports = function(grunt){

	grunt.initConfig({

		less: {
			production: {
				files: {
					"css/style.css": "less/style.less"
				}
			}
		},
	
		cssmin: {
			combine: {
				files: {
					'style.css': [
						'css/wp-header.css',
						'components/bootstrap/docs/assets/css/bootstrap.css', 
						'components/bootstrap/docs/assets/css/bootstrap-responsive.css',
						'css/icon-fonts/metro/style.css',
						'css/fonts/raleway_thin/stylesheet.css',
						'css/fonts/junction/stylesheet.css',
						'css/colors/brand/style.css',
						'css/style.css'
					]
				}
			}
		}
	
	});

	grunt.registerTask('default', ['less', 'cssmin']);
	
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-less');
	
};