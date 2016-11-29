var gulp = require('gulp');
var sass = require('gulp-sass');
var rename = require('gulp-rename');
var cssnano = require('gulp-cssnano');
var livereload = require('gulp-livereload');

gulp.task('sass', function() {
    return gulp.src('sass/style.scss')
        .pipe(sass())
        .pipe(cssnano())
        .pipe(rename('custom-style.css'))
        .pipe(gulp.dest('css'))
        .pipe(livereload());
});

//Watch task
gulp.task('watch', function () {
    livereload.listen();
    gulp.watch('./sass/**/*.scss', ['sass']);
});