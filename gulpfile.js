var gulp   	   = require('gulp'),
	concat     = require('gulp-concat'),
	sass   	   = require('gulp-sass'),
	minifyCss  = require('gulp-minify-css'),
	coffee 	   = require('gulp-coffee'),
	coffeelint = require('gulp-coffeelint'),
	sourcemaps = require('gulp-sourcemaps'),
	plumber    = require('gulp-plumber'),
	uglify 	   = require('gulp-uglify'),
	rimraf     = require('gulp-rimraf'),
	merge      = require('gulp-merge');

// example tasks
// gulp.task('styles', function(){});
// gulp.task('scripts', function(){});
// gulp.task('build', function(){});