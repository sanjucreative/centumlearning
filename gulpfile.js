// Gulp.js configuration
'use strict';

var gulp = require('gulp'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    cssmin = require('gulp-clean-css'),
    autoprefixer = require('gulp-autoprefixer'),
    del = require('del'),
    browserSync = require('browser-sync');

gulp.task('clean', function (cb) {
    del.sync('assets');
    cb();
});

gulp.task('sass', function () {
    return gulp.src([
            'node_modules/bootstrap/scss/bootstrap.scss',
        //    'src/plugins/font-awesome/font-awesome.css',
            'src/scss/*.scss'
        ])

        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(concat('theme-style.css'))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('assets/css'))
        .pipe(browserSync.stream());
});

gulp.task('css:build', gulp.series('sass', function () {
    return gulp.src('assets/css/theme-style.css')
        .pipe(cssmin())
        .pipe(rename('theme-style.min.css'))
        .pipe(gulp.dest('assets/css'));
}));


gulp.task('vendor:js', function () {
    return gulp.src([
//            'node_modules/jquery/dist/jquery.min.js',
//			  'src/plugins/bootstrap/bootstrap.min.js',
              'src/js/*.js'
        ])
        .pipe(concat('theme-function.js'))
        .pipe(gulp.dest('assets/js'))
        .pipe(browserSync.stream());
});

gulp.task('js:build', gulp.series('vendor:js', function () {
    return gulp.src('assets/js/theme-function.js')
        .pipe(uglify())
        .pipe(rename('theme-function.min.js'))
        .pipe(gulp.dest('assets/js'));
}));



gulp.task('default', gulp.series('clean', 'js:build', 'css:build', function () {
    return gulp.src([
            'src/images/**',
            'src/js/*.js',
            'src/scss/*.css',
            'src/plugins/**'
        ], {
            base: './src'
        })
        .pipe(gulp.dest('assets'));
}));




gulp.task('serve', gulp.series('default', function () {
    //browserSync.init({
    //    server: './'
    //});
    browserSync.init({
        notify: false,
        open: 'local',
        proxy: {
          target: 'http://localhost/myres/centumlearning/',
          ws: false
        },
        ghostMode: false,
        https: false,
        port: 8080
      });

    

    gulp.watch([
        'src/scss/*.scss'
    ], gulp.series('css:build'), browserSync.reload());
    gulp.watch([
        'src/js/*.js'
    ], gulp.series('js:build'), browserSync.reload());
    gulp.watch([
        'src/images/**',
        'src/plugins/**'
    ], gulp.series('default'), browserSync.reload());
    gulp.watch([
        'src/js/theme-function.js'
    ], gulp.series(function () {
        return gulp.src([
                'src/js/*.js',
            ])
            .pipe(gulp.dest('assets/js'));
    }), browserSync.reload());
   // gulp.watch('*.php', browserSync.reload());
   
}));