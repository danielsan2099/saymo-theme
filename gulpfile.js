const gulp = require('gulp');
const sass = require('gulp-sass');
const cleanCSS = require('gulp-clean-css');

/* Solo SASS */
gulp.task('sass', function() {
    gulp.src('./style.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./'))
});
/* SASS con MINIFY */
gulp.task('mini', function() {
    gulp.src('./style.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(gulp.dest('./'))
});

// Solo SASS en default
gulp.task('default', ['sass']);

// Sass con watch
gulp.task('atento',function() {
    gulp.watch('./style.scss', ['sass']);
});