var gulp = require('gulp');
var babel = require('gulp-babel');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');

gulp.task('wp_post', function () {
	gulp.src('../app/webroot/js/WpPost/*.js')
	.pipe(concat('one.js'))
	.pipe(babel({
		presets: ['@babel/env']
	}))
	.pipe(uglify())
	.pipe(gulp.dest('../app/webroot/js/WpPost/dist'));
});