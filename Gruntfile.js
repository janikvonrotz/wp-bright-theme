module.exports = function(grunt){

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		cssmin: {
		combine: {
			files: {
				'cd $psp/to/output.css': ['path/to/input_one.css', 'path/to/input_two.css']
			}
		}
}
	});

	grunt.loadNpmTasks('grunt-contrib-cssmin');

};