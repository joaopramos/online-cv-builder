var gulp = require('gulp'),
    clean = require('del'),
    jshint = require('gulp-jshint'),
    stylish=require('jshint-stylish'),
    minifycss = require('gulp-minify-css'),
    minifyjs = require('gulp-uglify'),
    minifyhtml = require('gulp-minify-html'),
    autoprefixer = require('gulp-autoprefixer'),
    concat = require('gulp-concat'),
    connect = require('gulp-connect'),
    gulpFilter = require('gulp-filter'),
    filesize = require('gulp-filesize'),
    gulpJade = require('gulp-jade'),
    stylus = require('gulp-stylus'),
    nib = require('nib');

var paths = {
    styl: 'public/src/js/**/*.styl',
    css: 'public/src/js/**/*.css',
    js: 'public/src/js/**/*.js',
    templates: 'public/src/templates/**/*.html',
    jade: 'public/src/js/**/*.jade',
}
var dest = {
    css: 'public/dist/css/',
    js: 'public/dist/js/',
    templates: 'public/dist/templates',
}
var bowerCss = [
    'public/components/bootstrap-css-only/css/bootstrap.min.css',
    'public/components/font-awesome/css/font-awesome.min.css',
    'public/components/animate.css/animate.min.css',

    'public/components/ngtoast/dist/ngToast.min.css',
    paths.css, paths.styl];

var componentsJs = ['public/components/angular/angular.min.js',
    'public/components/angular-ui-utils/ui-utils.min.js',
    'public/changed-components/bootstrap.ui-fontsawesome/ui-bootstrap-tpls.js',
    'public/components/angular-ui-router/release/angular-ui-router.min.js',
    'public/components/angular-sanitize/angular-sanitize.min.js',
    'public/components/angular-animate/angular-animate.min.js',

    'public/components/ngtoast/dist/ngToast.min.js',

    'public/components/jquery/dist/jquery.min.js',
    'public/components/angular-base64-upload/dist/angular-base64-upload.min.js',
    ];

var srcJs=[paths.js];

gulp.task('css', function() {
 var filter = gulpFilter('**/*.styl');
    return gulp.src(bowerCss)
        .pipe(filter)
        .pipe(stylus({error: true, use: [nib()]})).on('error', function(er){console.log(er); this.emit('end');})
        .pipe(filter.restore())
        .pipe(autoprefixer('last 15 version'))
        .pipe(minifycss())
        .pipe(concat('main.min.css'))
        .pipe(gulp.dest(dest.css))
        .pipe(filesize());
});

gulp.task('components', function() {
     return gulp.src(componentsJs)
       .pipe(minifyjs())
        .pipe(concat('main.min.js'))
        .pipe(gulp.dest(dest.js))
});

gulp.task('js', function() {
 var filter = gulpFilter('**/*.coffee');
    return gulp.src(srcJs)
        .pipe(filter)
       // .pipe(coffee({bare: true}).on('error', function(err){}))
        .pipe(filter.restore())
        .pipe(jshint('.jshintrc'))
        .pipe(jshint.reporter(stylish))
        .pipe(minifyjs()).on('error', function(er){console.log(er); this.emit('end');})
        .pipe(concat('app.min.js'))
        .pipe(gulp.dest(dest.js))
        .pipe(filesize());
});

gulp.task('icons', function() {
    return gulp.src('public/components/fontawesome/fonts/**.*')
        .pipe(gulp.dest('public/dist/fonts'));
});

gulp.task('templates', ['clean'], function() {
    return gulp.src(paths.templates)
        .pipe(minifyhtml({
            empty: true,
            cdata: true,
            spare: true,
        }))
        .pipe(gulp.dest(dest.templates));
});

gulp.task('jade', ['templates'], function() {
    return gulp.src(paths.jade)
    .pipe(gulpJade({pretty: true})).on('error', function(er){console.log(er); this.emit('end');})
    .pipe(gulp.dest(dest.templates));
});

gulp.task('clean', function() {
    clean(['public/dist/templates/*'], function (err, paths) {
        console.log('Deleted files/folders:\n', paths.join('\n'));
    });
});

gulp.task('watch', function() {
    gulp.watch(paths.css, ['css']);
    gulp.watch(paths.styl, ['css']);
    gulp.watch(paths.js, ['js']);
    //gulp.watch(paths.coffee, ['js']);
    gulp.watch(paths.templates, ['templates']);
    gulp.watch(paths.jade, ['jade']);
});


gulp.task('webserver', function() {
  connect.server({
    port:9000,
    livereload: true,
    root: ['public/dist']
  });
});

gulp.task('default', [ 'css', 'components', 'js',
    'icons', 'templates', 'jade', 'watch']);
