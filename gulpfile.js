var gulp = require('gulp'),
    browserify = require('browserify'),
    source = require('vinyl-source-stream'),
    sass = require('gulp-ruby-sass');

var config = {
    src: 'markpress/src',
    libs: 'markpress/src/libs',
    dist: 'markpress/assets'
};
var pkg = require('./package.json');

gulp.task('browserify', function () {
    'use strict';
    return browserify('./' + config.src + '/js/markpress.js')
        .bundle()
        .on('error', function (err) {
            console.log(err.toString());
            this.emit('end');
        })
        .pipe(source('markpress.js'))
        .pipe(gulp.dest(config.dist + '/js/'));
});

gulp.task('sass', function() {
    'use strict';

    return gulp.src(config.src + '/sass/style.scss')
        .pipe(sass({
            style: 'expanded',
            loadPath: __dirname + '/' + config.src + '/sass/'
        }).on('error', function (err) {
            console.log(err.toString());
            this.emit('end');
        }))
        .pipe(gulp.dest(config.dist + '/css/'));
});

gulp.task('watch', ['browserify', 'sass'], function () {
    'use strict';

    //js
    gulp.watch(config.src + "/js/**/*.js", ['browserify']);

    //sass
    gulp.watch(config.src + "/sass/**/*.scss", ['sass']);
});