var gulp = require('gulp'),
    sass = require('gulp-sass'),
    concat = require('gulp-concat'),
    del = require('del');

gulp.task('sass-to-css', function () {
    gulp.src('./src/stylesheets/main.scss')
    .pipe(sass({style: 'compressed'}))
    .pipe(gulp.dest('./public/stylesheets'));
});

gulp.task('combine', function () {
    gulp.src(['./public/stylesheets/bootstrap.min.css', './public/stylesheets/main.css'])
    .pipe(concat('application.css'))
    .pipe(gulp.dest('./public/stylesheets'));
});

gulp.task('build-jquery', function () {
	gulp.src('./src/vendor/jquery/dist/jquery.min.js')
	.pipe(gulp.dest('./public/javascripts'));
});

gulp.task('build-bootstrap-js', function () {
	gulp.src('./src/vendor/bootstrap/dist/js/bootstrap.min.js')
	.pipe(gulp.dest('./public/javascripts'));
});

gulp.task('build-bootstrap-css', function () {
	gulp.src('./src/vendor/bootstrap/dist/css/bootstrap.min.css')
	.pipe(gulp.dest('./public/stylesheets'));
});

gulp.task('build-bootstrap-fonts', function () {
	gulp.src('./src/vendor/bootstrap/dist/fonts/*.{ttf,woff,eot,svg}')
	.pipe(gulp.dest('./public/fonts'));
});

gulp.task('default', [
    'build-jquery',
    'build-bootstrap-fonts',
    'build-bootstrap-css',
    'build-bootstrap-js',
    'sass-to-css',
    'combine'
]);

